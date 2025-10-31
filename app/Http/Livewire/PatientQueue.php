<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PatientQueue extends Component
{
    // Properties for binding; contoh: selected loket, patient name
    public $loketId;
    public $patientName;

    // Mount values (optional)
    public function mount($loketId = null)
    {
        $this->loketId = $loketId;
    }

    // Generate antrian via API - implement frontend call di blade/JS
    public function generate()
    {
        // Di sini kita bisa memanggil endpoint API internal atau emit event
        // Untuk skeleton, kita hanya menyiapkan method agar developer bisa menambahkan logic
    }

    public function render()
    {
        return view('livewire.patient-queue');
    }
}
