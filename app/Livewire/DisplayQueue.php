<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Antrian;
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
        // Ambil semua antrian yang sedang dipanggil
        $called = Antrian::where('status', Antrian::STATUS_CALLED)
            ->with('loket')
            ->orderBy('called_at', 'desc')
            ->get();

        // Ambil beberapa antrian berikutnya (waiting)
        $next = Antrian::where('status', Antrian::STATUS_WAITING)
            ->with('loket')
            ->orderBy('created_at', 'asc')
            ->limit(3)
            ->get();

        return view('livewire.display-queue', ['called' => $called, 'next' => $next]);
    }
}
