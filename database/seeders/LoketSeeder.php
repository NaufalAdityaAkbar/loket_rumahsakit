<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loket;

class LoketSeeder extends Seeder
{
    public function run(): void
    {
        // use short names (A/B/C) so generated nomor prefix uses the letter directly
        $lokets = [
            ['name' => 'A', 'type' => 'Umum', 'description' => 'Loket pelayanan umum'],
            ['name' => 'B', 'type' => 'Poli Gigi', 'description' => 'Loket poli gigi'],
            ['name' => 'C', 'type' => 'Farmasi', 'description' => 'Loket pengambilan obat'],
        ];

        foreach ($lokets as $loket) {
            Loket::create($loket);
        }
    }
}