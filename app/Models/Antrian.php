<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Loket;
use Illuminate\Support\Facades\DB;

class Antrian extends Model
{
    use HasFactory;

    // Status constants to avoid magic strings across code
    public const STATUS_WAITING = 'waiting';
    public const STATUS_CALLED = 'called';
    public const STATUS_FINISHED = 'finished';

    protected $fillable = [
        'nomor',
        'loket_id',
        'patient_name',
        'status',
        'called_at',
    ];

    // Relationship: antrian belongs to loket
    public function loket()
    {
        return $this->belongsTo(Loket::class);
    }

    /**
     * Generate and create antrian for a given loket.
     * Format: {PREFIX}{NNN} e.g. A001
     * Prefix is derived from loket name first letter (fallback 'U').
     * NOTE: This is a simple implementation and may have race conditions under high concurrency.
     */
    public static function generateForLoket(?int $loketId = null, ?string $patientName = null): self
    {
        // Determine prefix
        $prefix = 'U';
        if ($loketId) {
            $loket = Loket::find($loketId);
            if ($loket && !empty($loket->name)) {
                // take first alpha character of name
                $onlyLetters = preg_replace('/[^A-Za-z]/', '', $loket->name);
                $prefix = strtoupper(substr($onlyLetters ?: $loket->id, 0, 1));
            }
        }

        // Find last nomor for this loket (prefer checking loket_id); fallback to any nomor with same prefix
        $last = self::where('loket_id', $loketId)
            ->where('nomor', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if (! $last) {
            // try any with same prefix
            $last = self::where('nomor', 'like', $prefix . '%')
                ->orderBy('id', 'desc')
                ->first();
        }

    $nextNum = 1;
        if ($last && preg_match('/(\d+)$/', $last->nomor, $m)) {
            $nextNum = intval($m[1]) + 1;
        }

        $numberPart = str_pad((string) $nextNum, 3, '0', STR_PAD_LEFT);
        $nomor = $prefix . $numberPart;

        // Create record
        return self::create([
            'nomor' => $nomor,
            'loket_id' => $loketId,
            'patient_name' => $patientName,
            'status' => self::STATUS_WAITING,
        ]);
    }

    /**
     * Call next waiting antrian for a loket (or fallback to unassigned queue).
     */
    public static function callNextForLoket(int $loketId): ?self
    {
        // Try to find next waiting for this loket
        $next = self::where('loket_id', $loketId)
            ->where('status', self::STATUS_WAITING)
            ->orderBy('created_at')
            ->first();

        if (! $next) {
            // fallback to unassigned
            $next = self::whereNull('loket_id')
                ->where('status', self::STATUS_WAITING)
                ->orderBy('created_at')
                ->first();
        }

        if (! $next) {
            return null;
        }

        $next->update([
            'status' => self::STATUS_CALLED,
            'called_at' => now(),
            'loket_id' => $loketId,
        ]);

        return $next;
    }
}
