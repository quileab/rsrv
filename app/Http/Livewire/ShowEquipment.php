<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipment;
use Livewire\WithFileUploads;

class ShowEquipment extends Component
{
    use WithFileUploads;

    public $confirm=['show'=>false,'title'=>'¿Estás seguro?','question'=>'¿Estás seguro de que quieres eliminar este equipo?'];
    public $confirmation=false;
    public $editModal=false;
    public $deleteEquipment=null;
    public $image=null;

    // equiment fields
    public $equip_id;
    public $equip_name='';
    public $equip_description='';
    public $equip_serial_number='';
    public $equip_model='';
    public $equip_manufacturer='';
    public $equip_location_id='';
    public $equip_image_path='';
    public $equip_price=0;
    public $equip_status='';

    public function render()
    {
        $equipment=Equipment::all();
        $locations=\App\Models\Location::all();
        return view('livewire.show-equipment',
        ['equipment'=>$equipment,'locations'=>$locations]);
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
        $this->editModal=false;
    }

    public function edit($id)
    {
        $equipment=Equipment::find($id);
        $this->equip_id=$equipment->id;
        $this->equip_name=$equipment->name;
        $this->equip_description=$equipment->description;
        $this->equip_serial_number=$equipment->serial_number;
        $this->equip_model=$equipment->model;
        $this->equip_manufacturer=$equipment->manufacturer;
        $this->equip_location_id=$equipment->location_id;
        $this->equip_image_path=$equipment->image_path;
        $this->equip_price=$equipment->price;
        $this->equip_status=$equipment->status;
        $this->editModal=true;
        //return redirect()->route('equipment');
    }

    public function saveEdit($id)
    {
        $equipment=Equipment::find($id);
        $equipment->name=$this->equip_name;
        $equipment->description=$this->equip_description;
        $equipment->serial_number=$this->equip_serial_number;
        $equipment->model=$this->equip_model;
        $equipment->manufacturer=$this->equip_manufacturer;
        $equipment->location_id=$this->equip_location_id;
        $equipment->image_path=$this->equip_image_path;
        $equipment->price=$this->equip_price;
        $equipment->status=$this->equip_status;
        $equipment->save();
        $this->editModal=false;
    }
    
    public function create()
    {
        $this->equip_id=null;
        $this->equip_name='';
        $this->equip_description='';
        $this->equip_serial_number='';
        $this->equip_model='';
        $this->equip_manufacturer='';
        $this->equip_location_id='';
        $this->equip_image_path='';
        $this->equip_price=0;
        $this->equip_status='';
        $this->editModal=true;
    }

    public function saveNewEquipment()
    { 
        // check this url: https://www.youtube.com/watch?v=iBIZhhMkZzU
        $equipment=new Equipment;
        $equipment->name=$this->equip_name;
        $equipment->description=$this->equip_description;
        $equipment->serial_number=$this->equip_serial_number;
        $equipment->model=$this->equip_model;
        $equipment->manufacturer=$this->equip_manufacturer;
        $equipment->location_id=$this->equip_location_id;
        $equipment->price=$this->equip_price;
        $equipment->status=$this->equip_status;
        $equipment->image_path=$this->image->store('public/images');
        $equipment->save();
        //dd($equipment);
        $this->editModal=false;
    }

    public function saveImage()
    {
        //todo: save image
    }
}

