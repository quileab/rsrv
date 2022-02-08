<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipment;

class ShowEquipment extends Component
{
    public function render()
    {
        $equipment=Equipment::all();
        return view('livewire.show-equipment',['equipment'=>$equipment]);
    }

    public function reserve($id)
    {
        $equipment=Equipment::find($id);
        session(['equipment'=>$equipment]);
        return redirect()->route('calendar');
    }
}

