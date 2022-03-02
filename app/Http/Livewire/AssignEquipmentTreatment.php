<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Equipment;
use App\Models\Treatment;
use Illuminate\Support\Facades\Session;

class AssignEquipmentTreatment extends Component
{

    public $equipments=[];
    public $treatments=[];
    public $equipment_search='';
    public $treatment_search='';
    public $selected_equipment=null;
    public $assigned_treaments=[];

    public function mount(){
        if (Session::has('equipment')) {
            $this->selected_equipment=session('equipment');
        }else{
            return redirect()->route('equipment');
        }
    }

    public function render()
    {
      $this->assigned_treatments=$this->selected_equipment->treatments()->get();
      return view('livewire.assign-equipment-treatment',
        [
          'assignedtreatments'=>$this->assigned_treatments,
        ]);
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
    }

}
