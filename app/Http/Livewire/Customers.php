<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class Customers extends Component
{
    public $confirm=['show'=>false,'title'=>'¿Borrar?','question'=>'¿Estás seguro?'];
    public $confirmation=false;
    public $editModal=false;
    public $deleteItem=null;
    public $search='';
    public $records=[];

    // Model Customer fields
    public $model_id;
    public $model_name='';
    public $model_pid=null;
    public $model_phone=null;
    public $model_email=null;
    public $model_address=null;
    public $model_location_id=null;
    public $model_user_id=null;

    public function mount()
    {
        $this->records=Customer::limit(15)->get();
    }    
    
    public function render(){
        $locations=\App\Models\Location::all();
        $users=\App\Models\User::all();
        return view('livewire.customers',
        ['records'=>$this->records,'locations'=>$locations,'users'=>$users]);
    }

    public function pin($id){
        session(['customer'=>Customer::find($id)]);
        $this->emit('notify');
        $this->emitTo('livewire-toast','show','Seleccionaste un cliente');
    }

    public function searchRecords(){
        $this->records=Customer::where('name','like','%'.$this->search.'%')->limit(15)->get();
    }

    public function deleteItem($id){
        $this->deleteItem=Customer::find($id);
        $this->confirm['title']='¿Borrar '.$this->model_name.'?';
        $this->confirm['question']='¿Estás seguro?';
        $this->confirm['show']=true;
    }

    public function delete(){
        $this->deleteItem->delete();
        $this->confirm['show']=false;
        $this->editModal=false;
    }

    public function edit($id){
        $record=Customer::find($id);
        $this->model_id=$record->id;
        $this->model_name=$record->name;
        $this->model_pid=$record->pid;
        $this->model_phone=$record->phone;
        $this->model_email=$record->email;
        $this->model_address=$record->address;
        $this->model_location_id=$record->location_id;
        $this->model_user_id=$record->user_id;
        $this->editModal=true;
    }

    public function saveEdit($id){
        $record=Customer::find($id);
        $record->name=$this->model_name;
        $record->pid=$this->model_pid;
        $record->phone=$this->model_phone;
        $record->email=$this->model_email;
        $record->address=$this->model_address;
        $record->location_id=$this->model_location_id;
        $record->user_id=$this->model_user_id;
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
        $this->model_user_id=null;
        $this->editModal=true;
    }

    public function saveNewItem(){ 
        $record=new Customer;
        $record->name=$this->model_name;
        $record->pid=$this->model_pid;
        $record->phone=$this->model_phone;
        $record->email=$this->model_email;
        $record->address=$this->model_address;
        $record->location_id=$this->model_location_id;
        $record->user_id=$this->model_user_id;
        $record->save();
        $this->editModal=false;
    }
}
