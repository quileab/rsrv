<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Treatment;

class Treatments extends Component
{
    public $confirm=['show'=>false,'title'=>'¿Borrar?','question'=>'¿Estás seguro?'];
    public $confirmation=false;
    public $editModal=false;
    public $deleteItem=null;

    // Model fields
    public $treatment_id;
    public $treatment_name='';
    public $treatment_duration=5;
    public $treatment_price=0;
    public $treatment_operatorPrice=0;

    public function render(){
        $treatments=Treatment::all();
        return view('livewire.treatments',['treatments'=>$treatments]);
    }

    public function deleteItem($id){
        $this->deleteItem=Treatment::find($id);
        $this->confirm['title']='¿Borrar '.$this->treatment_name.'?';
        $this->confirm['question']='¿Estás seguro?';
        $this->confirm['show']=true;
    }

    public function delete(){
        $this->deleteItem->delete();
        $this->confirm['show']=false;
        $this->editModal=false;
    }

    public function edit($id){
        $treatment=Treatment::find($id);
        $this->treatment_id=$treatment->id;
        $this->treatment_name=$treatment->name;
        $this->treatment_duration=$treatment->duration;
        $this->treatment_price=$treatment->price;
        $this->treatment_operatorPrice=$treatment->operatorPrice;
        $this->editModal=true;
    }

    public function saveEdit($id){
        $treatment=Treatment::find($id);
        $treatment->name=$this->treatment_name;
        $treatment->duration=$this->treatment_duration;
        $treatment->price=$this->treatment_price;
        $treatment->operatorPrice=$this->treatment_operatorPrice;
        $treatment->save();
        $this->editModal=false;
    }
    
    public function create(){
        $this->treatment_id=null;
        $this->treatment_name='';
        $this->treatment_duration=5;
        $this->treatment_price=0;
        $this->treatment_operatorPrice=0;
        $this->editModal=true;
    }

    public function saveNewItem(){ 
        $treatment=new Treatment;
        $treatment->name=$this->treatment_name;
        $treatment->duration=$this->treatment_duration;
        $treatment->price=$this->treatment_price;
        $treatment->operatorPrice=$this->treatment_operatorPrice;
        $treatment->save();
        $this->editModal=false;
    }
}