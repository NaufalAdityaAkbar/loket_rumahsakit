<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loket;
use Illuminate\Http\Request;

class LoketController extends Controller
{
    // Return list of loket
    public function index()
    {
        // Simple listing - later dapat ditambah paging, filter, permission
        return response()->json(Loket::all());
    }

    // Store a new loket
    public function store(Request $request)
    {
        // Validasi input minimal sebelum simpan
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $loket = Loket::create($data);

        return response()->json($loket, 201);
    }

    // Show single loket
    public function show(Loket $loket)
    {
        return response()->json($loket);
    }

    // Update loket
    public function update(Request $request, Loket $loket)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'type' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $loket->update($data);

        return response()->json($loket);
    }

    // Hapus loket
    public function destroy(Loket $loket)
    {
        // Hapus sederhana; jika ingin soft delete, ubah model dan migrasi
        $loket->delete();

        return response()->json(['message' => 'Loket deleted']);
    }
}
