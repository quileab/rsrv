<?php

namespace App\Http\Livewire;

use App\Models\Operator;
use Livewire\Component;

class Operators extends Component
{
    public $confirm=['show'=>false,'title'=>'¿Borrar?','question'=>'¿Estás seguro?'];
    public $confirmation=false;
    public $editModal=false;
    public $deleteItem=null;

    // Model Customer fields
    public $model_id;
    public $model_name='';
    public $model_pid=null;
    public $model_phone=null;
    public $model_email=null;
    public $model_address=null;
    public $model_location_id=null;

    public function render(){
        $records=Operator::all();
        $locations=\App\Models\Location::all();
        return view('livewire.operators',
        ['records'=>$records,'locations'=>$locations]);
    }

    public function pin($id){
        session(['operator'=>Operator::find($id)]);
    }

    public function deleteItem($id){
        $this->deleteItem=Operator::find($id);
        $this->confirm['title']='¿Borrar '.$this->model_name.'?';
        $this->confirm['question']='¿Estás seguro?';
        $this->confirm['show']=true;
    }

    public function delete(){
        $this->deleteItem->delete();
        $this->editModal=false;
    }

    public function edit($id){
        $record=Operator::find($id);
        $this->model_id=$record->id;
        $this->model_name=$record->name;
        $this->model_pid=$record->pid;
        $this->model_phone=$record->phone;
        $this->model_email=$record->email;
        $this->model_address=$record->address;
        $this->model_location_id=$record->location_id;
        $this->editModal=true;
    }

    public function saveEdit($id){
        $record=Operator::find($id);
        $record->name=$this->model_name;
        $record->pid=$this->model_pid;
        $record->phone=$this->model_phone;
        $record->email=$this->model_email;
        $record->address=$this->model_address;
        $record->location_id=$this->model_location_id;
        $record->save();
        $this->editModal=false;
    }
    
    public function create(){
        $this->model_id=null;
        $this->model_name='';
        $this->model_pid=null;
        $this->model_phone='';
        $this->model_email='';
        $this->model_address='';
        $this->model_location_id=null;
        $this->editModal=true;
    }

    public function saveNewItem(){ 
        $record=new Operator;
        $record->name=$this->model_name;
        $record->pid=$this->model_pid;
        $record->phone=$this->model_phone;
        $record->email=$this->model_email;
        $record->address=$this->model_address;
        $record->location_id=$this->model_location_id;
        $record->save();
        $this->editModal=false;
    }
}
