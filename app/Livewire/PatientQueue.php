<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Loket;
use App\Models\Antrian;
use Illuminate\Support\Facades\DB;

class PatientQueue extends Component
{
    public $loketId = '';
    public $patientName = '';
    public $nomor = '';
    public $success = false;
    public $error = '';
    public $lokets = [];

    public function mount()
    {
        // keep as a collection so Blade can access ->id / ->name easily
        $this->lokets = Loket::all();
    }

    public function generate()
    {
        $this->error = '';
        $this->success = false;
        $this->nomor = '';

        try {
            $antrian = Antrian::generateForLoket($this->loketId, $this->patientName ?: null);
            $this->nomor = $antrian->nomor;
            $this->success = true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }

    // Convenience: select a loket and immediately generate a number (used by big buttons)
    public function generateWithLoket($loketId)
    {
        $this->loketId = $loketId;
        // clear patient name for button-driven flow
        $this->patientName = '';
        $this->generate();
    }

    public function render()
    {
        if (empty($this->lokets) || $this->lokets->isEmpty()) {
            $this->lokets = Loket::all();
        }
        return view('livewire.patient-queue', [
            'lokets' => $this->lokets,
            'error' => $this->error,
            'success' => $this->success,
            'nomor' => $this->nomor,
        ]);
    }
}
