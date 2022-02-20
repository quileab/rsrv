<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;

class Locations extends Component
{

    public $confirm=['show'=>false,'title'=>'¿Borrar?','question'=>'¿Estás seguro?'];
    public $confirmation=false;
    public $editModal=false;
    public $deleteItem=null;

    // location fields
    public $location_id;
    public $location_name='';
    public $location_address='';
    public $location_phone='';
    public $location_email='';

    public function render()
    {
        $locations=Location::all();
        return view('livewire.locations',['locations'=>$locations]);
    }

    public function pinLocation($id)
    {
        session(['location'=>Location::find($id)]);
        $this->emit('notify');
    }

    public function deleteItem($id)
    {
        $this->deleteItem=Location::find($id);
        $this->confirm['title']='¿Borrar '.$this->location_name.'?';
        $this->confirm['question']='¿Estás seguro?';
        $this->confirm['show']=true;
    }

    public function delete()
    {
        $this->deleteItem->delete();
        $this->confirm['show']=false;
        $this->editModal=false;
    }

    public function edit($id)
    {
        $location=Location::find($id);
        $this->location_id=$location->id;
        $this->location_name=$location->name;
        $this->location_address=$location->address;
        $this->location_phone=$location->phone;
        $this->location_email=$location->email;
        $this->editModal=true;
    }

    public function saveEdit($id)
    {
        $location=Location::find($id);
        $location->name=$this->location_name;
        $location->address=$this->location_address;
        $location->phone=$this->location_phone;
        $location->email=$this->location_email;
        $location->save();
        $this->editModal=false;
    }
    
    public function create()
    {
        $this->location_id=null;
        $this->location_name='';
        $this->location_address='';
        $this->location_phone='';
        $this->location_email='';
        $this->editModal=true;
    }

    public function saveNewItem()
    { 
        $location=new Location;
        $location->name=$this->location_name;
        $location->address=$this->location_address;
        $location->phone=$this->location_phone;
        $location->email=$this->location_email;
        $location->save();
        $this->editModal=false;
    }

}
