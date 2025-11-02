<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Antrian;
use App\Models\Loket;
use Livewire\Attributes\Lazy;

#[Lazy]
class PetugasQueue extends Component
{
    // Status constants
    const STATUS_WAITING = 'waiting';
    const STATUS_CALLED = 'called';
    const STATUS_FINISHED = 'finished';

    public $loketId;
    public $waitingList = [];
    public $currentCalled = null;

    public function mount($loketId = null)
    {
        $this->loketId = $loketId;
    }

    public function updatedLoketId($value)
    {
        $this->loadQueueData();
    }

    protected function loadQueueData()
    {
        if ($this->loketId) {
            $this->waitingList = Antrian::where('loket_id', $this->loketId)
                ->where('status', Antrian::STATUS_WAITING)
                ->orderBy('created_at')
                ->get();

            $this->currentCalled = Antrian::where('loket_id', $this->loketId)
                ->where('status', Antrian::STATUS_CALLED)
                ->orderBy('called_at', 'desc')
                ->first();
        }
    }

    // Memanggil antrian berikutnya untuk loket ini
    public function callNext()
    {
        if (! $this->loketId) {
            $this->addError('loket', 'Pilih loket terlebih dahulu');
            return;
        }

        $called = Antrian::callNextForLoket($this->loketId);
        if ($called) {
            $this->currentCalled = $called;
        } else {
            $this->addError('empty', 'Tidak ada antrian menunggu');
        }
    }

    // Memanggil antrian spesifik (dipilih oleh petugas)
    public function callSpecific($antrianId)
    {
        if (! $this->loketId) {
            $this->addError('loket', 'Pilih loket terlebih dahulu');
            return;
        }

        $a = Antrian::find($antrianId);
        if (! $a || $a->status !== Antrian::STATUS_WAITING) {
            $this->addError('notfound', 'Antrian tidak valid atau tidak menunggu');
            return;
        }

        $a->update([
            'status' => Antrian::STATUS_CALLED,
            'called_at' => now(),
            'loket_id' => $this->loketId,
        ]);

        $this->currentCalled = $a;
    }

    // Update status antrian (selesai)
    public function finish($antrianId)
    {
        $a = Antrian::find($antrianId);
        if (! $a) {
            $this->addError('notfound', 'Antrian tidak ditemukan');
            return;
        }

        $a->update(['status' => Antrian::STATUS_FINISHED]);
        // bila antrian yang sedang dipanggil selesai, kosongkan currentCalled
        if ($this->currentCalled && $this->currentCalled->id == $antrianId) {
            $this->currentCalled = null;
        }
    }

    public function render()
    {
        if ($this->loketId) {
            $this->waitingList = Antrian::where('loket_id', $this->loketId)
                ->where('status', Antrian::STATUS_WAITING)
                ->orderBy('created_at')
                ->get();

            $this->currentCalled = Antrian::where('loket_id', $this->loketId)
                ->where('status', Antrian::STATUS_CALLED)
                ->orderBy('called_at', 'desc')
                ->first();
        } else {
            $this->waitingList = collect();
            $this->currentCalled = null;
        }

        $lokets = Loket::all();
        return view('livewire.petugas-queue', [
            'lokets' => $lokets,
            'waitingList' => $this->waitingList,
            'currentCalled' => $this->currentCalled
        ]);
    }
}
