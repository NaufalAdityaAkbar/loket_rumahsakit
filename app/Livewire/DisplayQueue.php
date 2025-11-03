<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Antrian;
use App\Models\Loket;
use Livewire\Attributes\Lazy;

#[Lazy]
class DisplayQueue extends Component
{
    // Menyajikan nomor yang sedang dipanggil; bisa di-polling atau via websockets
    public $current;

    public function mount()
    {
        $this->current = null;
    }

    public function render()
    {
        // Ambil semua loket
        $lokets = Loket::with(['antrians' => function($query) {
            $query->whereIn('status', [Antrian::STATUS_CALLED, Antrian::STATUS_WAITING])
                ->orderBy('status', 'desc')  // Called first, then waiting
                ->orderBy('called_at', 'desc')
                ->orderBy('created_at', 'asc')
                ->limit(4);  // 1 current + 3 next
        }])->get();

        return view('livewire.display-queue', ['lokets' => $lokets]);
    }
}
