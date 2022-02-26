<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipment;
use App\Models\Treatment;
use Carbon\Carbon;

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
      $assignedtreatments=$this->selected_equipment->treatments;
      session(['message'=>Carbon::now()->format('d-m-Y H:i:s')." - ".$this->selected_equipment->name]);
      $this->emit('notify');
      return view('livewire.assign-equipment-treatment',
        compact('assignedtreatments'));
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
    }

    public function assignTreatment($treatment_id){
        $treatment=Treatment::find($treatment_id);
        $this->selected_equipment->treatments()->attach($treatment);
    }

    public function unassignTreatment($treatment_id){
        $treatment=Treatment::find($treatment_id);
        $this->selected_equipment->treatments()->detach($treatment);
        session(['message'=>'Tratamiento BORRADO correctamente']);
        $this->emit('notify');
    }

}
