<div>
    {{-- jetstream modal to confirm deletion --}}
    <x-jet-dialog-modal wire:model="confirm.show">
      <x-slot name="title">{{ $confirm['title'] }}</x-slot>
      <x-slot name="content">{{ $confirm['question'] }}</x-slot>
      <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirm.show')">
          Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button class="ml-2" wire:click="delete()">
          <x-svg.trash class="w-5 h-5" />&nbsp;Borrar
        </x-jet-danger-button>
      </x-slot>
    </x-jet-dialog-modal>
  
    {{-- jetstream modal to edit equipment --}}
    <x-jet-dialog-modal wire:model="editModal">
      <x-slot name="title">Editar Tratamiento » <small>#{{ $treatment_id }}</small></x-slot>
      <x-slot name="content">
        <div class="flex justify-between w-full my-1">
          <div class="w-1/2 mx-1">
            <x-jet-label for="treatment_name">Nombre</x-label>
              <x-jet-input type="text" wire:model.defer="treatment_name" maxlength="60" />
              <x-jet-input-error for="treatment_name" class="mt-1" />
          </div>
          <div class="w-1/2 mx-2">
            <x-jet-label for="treatment_duration">Duración <small>minutos</small></x-label>
              <x-jet-input type="number" wire:model.defer="treatment_duration" min="5" step="5" />
              <x-jet-input-error for="treatment_duration" class="mt-1" />
          </div>
        </div>
        <div class="flex justify-between w-full my-1">
          <div class="mx-1 w-1/2">
            <x-jet-label for="treatment_price">Precio</x-label>
              <x-jet-input type="text" wire:model.defer="treatment_price" maxlength="60" />
              <x-jet-input-error for="treatment_price" class="mt-1" />
          </div>
          <div class="mx-1 w-1/2">
            <x-jet-label for="treatment_operatorPrice">Costo Operador</x-label>
              <x-jet-input type="email" wire:model.defer="treatment_operatorPrice" maxlength="60" />
              <x-jet-input-error for="treatment_operatorPrice" class="mt-1" />
          </div>
        </div>
      </x-slot>
      <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('editModal')">
          Cancelar
        </x-jet-secondary-button>
        @if ($treatment_id == null)
          <x-jet-danger-button class="ml-2" wire:click="saveNewItem()">
            Crear
          </x-jet-danger-button>
        @else
          <x-jet-button class="ml-2" wire:click="saveEdit({{ $treatment_id }})">
            Guardar
          </x-jet-button>
        @endif
      </x-slot>
    </x-jet-dialog-modal>
  
    <div class="flex flex-wrap justify-around px-6">
      @if (Auth::user()->role == 'admin')
      <div class="w-full flex justify-end my-1">
        <button type="button" wire:click='create()'
          class="flex items-center bg-indigo-600 text-white w-36 px-4 py-2 font-medium text-xs uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>&nbsp;
          Agregar
        </button>
      </div>
      @endif
  
      <table class="table-auto w-full rounded-md overflow-hidden shadow-md">
        <thead class="bg-gray-900 text-gray-100">
          <tr class="text-xs uppercase">
            <th class="px-4 py-2">Nombre</th>
            <th class="px-4 py-2">Duración</th>
            <th class="px-4 py-2">Precio</th>
            <th class="px-4 py-2">Operador</th>
            <th class="px-4 py-2">Acciones</th>
          </tr>
        </thead>
        <tbody class="bg-gray-100">
          @foreach ($treatments as $treatment)
            <tr class="text-left text-gray-900">
              <td class="border-2 px-4 py-2">{{ $treatment->name }}</td>
              <td class="border-2 px-4 py-2 text-right">{{ $treatment->duration }}</td>
              <td class="border-2 px-4 py-2 text-right">{{ $treatment->price }}</td>
              <td class="border-2 px-4 py-2 text-right">{{ $treatment->operatorPrice }}</td>
              <td class="border-2 px-4 py-2 w-14">
                  <div class="flex">
                <button type="button" wire:click='edit({{ $treatment->id }})'
                  class="flex bg-indigo-600 text-white w-full px-4 py-1 rounded-l shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out items-center">
                  <x-svg.edit class="h-5 w-5" />
                </button>
                <button type="button" wire:click='deleteItem({{ $treatment->id }})'
                  class="flex bg-red-600 text-white w-full px-4 py-1 rounded-r shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out items-center">
                  <x-svg.trash class="h-5 w-5" />
                </button>
              </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  