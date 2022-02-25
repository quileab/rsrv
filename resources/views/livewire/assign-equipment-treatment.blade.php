<div>
  <div class="flex flex-wrap bg-white bg-opacity-90 rounded-lg shadow-lg p-4 m-3">
    <div class="md:w-1/3 w-full p-4">

      <div class="flex border-2 rounded-md items-center">
        &nbsp;Equipos&nbsp;
        <x-jet-input type="text" class="border-0 px-4 py-2 w-full" placeholder="buscar..."
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
              <td class="border px-4 py-2">{{ $equipment->name }}</td>
              <td class="border px-4 py-2">
                {{-- button wire:click to assign function assignEquipment($equipment->id) --}}
                <button wire:click="selectEquipment({{ $equipment->id }})"
                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                  Seleccionar
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
          @foreach ($equipment_treatments as $assignedTreatment)
            <tr>
              <td class="border px-4 py-2">{{ $assignedTreatment->name }}</td>
              <td class="border px-4 py-2">
                {{-- button wire:click to unassign function unassignTreatment($assignedTreatment->id) --}}
                <button wire:click="unassignTreatment({{ $assignedTreatment->id }})"
                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                  Quitar
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="w-1/3 p-4">

      <div class="flex border-2 rounded-md items-center">
        &nbsp;Tratamientos&nbsp;
        <x-jet-input type="text" class="border-0 px-4 py-2 w-full" placeholder="buscar..."
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
              <td class="border px-4 py-2">{{ $treatment->name }}</td>
              <td class="border px-4 py-2">
                {{-- button to a function treatment assign (treatment->id) --}}
                <button wire:click="assignTreatment({{ $treatment->id }})"
                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                  Asignar
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
