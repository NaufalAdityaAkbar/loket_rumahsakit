<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Loket;

class MasterLoket extends Component
{
    public $name = '';
    public $type = '';
    public $description = '';
    public $showList = false;

    protected $rules = [
        'name' => 'required|string|max:50',
        'type' => 'nullable|string|max:50',
        'description' => 'nullable|string|max:255',
    ];

    public function addLoket()
    {
        $this->validate();

        Loket::create([
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
        ]);

        $this->name = $this->type = $this->description = '';
        $this->dispatchBrowserEvent('loket-added');
    }

    public function deleteLoket($id)
    {
        $l = Loket::find($id);
        if ($l) $l->delete();
    }

    public function render()
    {
        $lokets = Loket::orderBy('id')->get();
        return view('livewire.master-loket', ['lokets' => $lokets]);
    }
}
