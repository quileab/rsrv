<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipment;
use App\Models\Treatment;

class AssignEquipmentTreatment extends Component
{

    public $equipments=[];
    public $treatments=[];
    public $equipment_search='';
    public $treatment_search='';
    public $equipment_treatments=[];
    public $selected_equipment=null;


    public function mount(){
        if(session('equipment')){
            $this->selected_equipment=session('equipment');
        }
    }

    public function render()
    {
        return view('livewire.assign-equipment-treatment',['equipment_treatments'=>$this->equipment_treatments]);
    }

    public function EquipmentSearch(){
        $equipments=Equipment::where('name','like','%'.$this->equipment_search.'%')->get();
        $this->equipments=$equipments;
    }
    public function updatedEquipmentSearch(){
        $this->EquipmentSearch();
    }

    public function TreatmentSearch(){
        $treatments=Treatment::where('name','like','%'.$this->treatment_search.'%')->get();
        $this->treatments=$treatments;
    }
    
    public function updatedTreatmentSearch(){
        $this->TreatmentSearch();
    }

    public function selectEquipment($equipment_id){
        $this->selected_equipment=Equipment::find($equipment_id);
        session(['equipment'=>$this->selected_equipment]);
        // TODO: Get treatments for this equipment
        $this->equipment_treatments=$this->selected_equipment->treatments;
    }

    public function unassign($equipment_id,$treatment_id){
        $equipment=Equipment::find($equipment_id);
        $treatment=Treatment::find($treatment_id);
        $equipment->treatments()->detach($treatment);
        $this->equipment_treatments[$equipment_id]=array_diff($this->equipment_treatments[$equipment_id], [$treatment_id]);
    }

    public function getTreatments($equipment_id){
        return $this->equipment_treatments[$equipment_id];
    }

    public function getEquipments($treatment_id){
        $equipments=[];
        foreach(Equipment::all() as $equipment){
            if(in_array($treatment_id,$this->equipment_treatments[$equipment->id])){
                $equipments[]=$equipment;
            }
        }
        return $equipments;
    }

}
