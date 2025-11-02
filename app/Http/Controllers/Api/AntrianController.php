<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Loket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AntrianController extends Controller
{
    // List antrian (optionally by loket or status)
    public function index(Request $request)
    {
        $query = Antrian::query();

        if ($request->filled('loket_id')) {
            $query->where('loket_id', $request->loket_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return response()->json($query->orderBy('id', 'desc')->get());
    }

    // Generate number / create antrian baru
    public function generate(Request $request)
    {
        // Validasi sederhana
        $data = $request->validate([
            'loket_id' => 'nullable|exists:lokets,id',
            'patient_name' => 'nullable|string|max:255',
        ]);

        // Buat antrian menggunakan helper model agar format nomor konsisten per loket
        $antrian = Antrian::generateForLoket($data['loket_id'] ?? null, $data['patient_name'] ?? null);

        // Response mengembalikan object antrian yang baru dibuat
        return response()->json($antrian, 201);
    }

    // Panggil nomor berikutnya untuk suatu loket
    public function callNext(Loket $loket)
    {
        $next = Antrian::callNextForLoket($loket->id);

        if (! $next) {
            return response()->json(['message' => 'No waiting queues'], 404);
        }

        return response()->json($next);
    }

    // Update status antrian (dipanggil / selesai / dll)
    public function update(Request $request, Antrian $antrian)
    {
        $data = $request->validate([
            'status' => 'required|string|in:' . implode(',', [Antrian::STATUS_WAITING, Antrian::STATUS_CALLED, Antrian::STATUS_FINISHED]),
        ]);

        // Jika status menjadi finished, bisa set field called_at atau finished time jika perlu
        $antrian->update($data);

        return response()->json($antrian);
    }

    // Hapus antrian (mis. cancel)
    public function destroy(Antrian $antrian)
    {
        $antrian->delete();
        return response()->json(['message' => 'Antrian deleted']);
    }
}
