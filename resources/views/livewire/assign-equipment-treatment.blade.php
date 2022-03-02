<div>
  <div class="flex flex-wrap p-4 m-3 bg-white rounded-lg shadow-lg bg-opacity-90">
    <div class="w-full p-4 md:w-1/3">

      <div class="flex items-center border-2 rounded-md">
        &nbsp;Equipos&nbsp;
        <x-jet-input type="text" class="w-full px-4 py-2 border-0" placeholder="buscar..."
          wire:model.defer="equipment_search" wire:keydown.enter="EquipmentSearch"/>
        <button wire:click="EquipmentSearch" class="flex items-center justify-center p-3 border-l-2">
          <x-svg.search class="w-5 h-5 text-gray-600" />
        </button>
      </div>

      {{-- table foreach equipments, with 2 columns, equipment->name and action "assign" --}}
      <table class="table-auto">
        <thead>
          <tr>
            <th class="px-4 py-2">Nombre</th>
            <th class="px-4 py-2">
              <x-svg.gear class="mx-auto" />
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($equipments as $equipment)
            <tr>
              <td class="px-4 py-2 border">{{ $equipment->name }}</td>
              <td class="px-4 py-2 border">
                {{-- button wire:click to assign function assignEquipment($equipment->id) --}}
                <button wire:click="selectEquipment({{ $equipment->id }})"
                  class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                  <x-svg.check class="w-5 h-5" />
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="w-1/3 p-4">
      <h1 class="text-lg text-gray-800">Tratamientos Asignados a <strong>{{ $selected_equipment->name}}</strong></h1>
      {{-- table foreach assigned treatments, with 2 columns, treatment->name and action "unassign" --}}
      <table class="table-auto">
        <thead>
          <tr>
            <th class="px-4 py-2">Nombre</th>
            <th class="px-4 py-2">
              <x-svg.gear class="mx-auto" />
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($assignedtreatments as $assignedTreatment)
            <tr>
              <td class="px-4 py-2 border">{{ $assignedTreatment->name }}</td>
              <td class="px-4 py-2 border">
                {{-- button wire:click to unassign function unassignTreatment($assignedTreatment->id) --}}
                <button wire:click="unassignTreatment({{ $assignedTreatment->id }})"
                  class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                  <x-svg.trash class="w-5 h-5" />
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="w-1/3 p-4">

      <div class="flex items-center border-2 rounded-md">
        &nbsp;Tratamientos&nbsp;
        <x-jet-input type="text" class="w-full px-4 py-2 border-0" placeholder="buscar..."
          wire:model.defer="treatment_search" wire:keydown.enter="TreatmentSearch"/>
        <button wire:click="TreatmentSearch" class="flex items-center justify-center p-3 border-l-2">
          <x-svg.search class="w-5 h-5 text-gray-600" />
        </button>
      </div>

      {{-- table with 2 columns, treatment->name and action "assign" --}}
      <table class="table-auto">
        <thead>
          <tr>
            <th class="px-4 py-2">Nombre</th>
            <th class="px-4 py-2">
              <x-svg.gear class="mx-auto" />
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($treatments as $treatment)
            <tr>
              <td class="px-4 py-2 border">{{ $treatment->name }}</td>
              <td class="px-4 py-2 border">
                {{-- button to a function treatment assign (treatment->id) --}}
                <button wire:click="assignTreatment({{ $treatment->id }})"
                  class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                  <x-svg.nodePlus class="w-5 h-5" />
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
