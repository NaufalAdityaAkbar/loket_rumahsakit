<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PetugasQueue extends Component
{
    public $loketId;

    public function mount($loketId = null)
    {
        $this->loketId = $loketId;
    }

    // Memanggil antrian berikutnya untuk loket ini
    public function callNext()
    {
        // Panggil API POST /api/antrians/{loket}/call-next
    }

    // Update status antrian (selesai)
    public function finish($antrianId)
    {
        // Panggil API update status ke finished
    }

    public function render()
    {
        return view('livewire.petugas-queue');
    }
}
