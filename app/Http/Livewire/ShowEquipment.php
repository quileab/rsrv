<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipment;

class ShowEquipment extends Component
{
    public $confirm=['show'=>false,'title'=>'¿Estás seguro?','question'=>'¿Estás seguro de que quieres eliminar este equipo?'];
    public $confirmation=false;
    public $edit=false;
    public $deleteEquipment=null;
    // equiment fields
    public $equip_name='';
    public $equip_description='';
    public $equip_serial_number='';
    public $equip_model='';
    public $equip_manufacturer='';
    public $equip_location='';
    public $equip_image_path='';
    public $equip_price=0;
    public $equip_status='';

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

    public function confirmDelete($id)
    {
        $this->deleteEquipment=Equipment::find($id);
        $this->confirm['title']='¿Borrar '.$this->deleteEquipment->name.'?';
        $this->confirm['question']='¿Estás seguro de que quieres eliminar este equipo?';
        $this->confirm['show']=true;
    }

    public function delete()
    {
        $this->deleteEquipment->delete();
        $this->confirm['show']=false;
        $this->edit=false;
    }

    public function edit($id)
    {
        $equipment=Equipment::find($id);
        session(['equipment'=>$equipment]);
        $this->edit=true;
        //return redirect()->route('equipment');
    }   
}

