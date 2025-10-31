<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
