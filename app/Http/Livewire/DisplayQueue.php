<?php

namespace App\Http\Livewire;

use Livewire\Component;

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
        return view('livewire.display-queue');
    }
}
