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
      <x-slot name="title">Editar Operador » <small>#{{ $model_id }}</small></x-slot>
      <x-slot name="content">
        <div class="flex justify-between w-full my-1">
          <div class="w-1/2 mx-1">
            <x-jet-label for="model_name">Nombre</x-label>
              <x-jet-input type="text" wire:model.defer="model_name" maxlength="60" />
              <x-jet-input-error for="model_name" class="mt-1" />
          </div>
          <div class="w-1/2 mx-2">
            <x-jet-label for="model_address">Dirección</x-label>
              <x-jet-input type="text" wire:model.defer="model_address" maxlength="60" />
              <x-jet-input-error for="model_address" class="mt-1" />
          </div>
        </div>
        <div class="flex justify-between w-full my-1">
          <div class="mx-1 w-1/2">
            <x-jet-label for="model_phone">Celular</x-label>
              <x-jet-input type="text" wire:model.defer="model_phone" maxlength="60" />
              <x-jet-input-error for="model_phone" class="mt-1" />
          </div>
          <div class="mx-1 w-1/2">
            <x-jet-label for="model_email">Email</x-label>
              <x-jet-input type="email" wire:model.defer="model_email" maxlength="60" />
              <x-jet-input-error for="model_email" class="mt-1" />
          </div>
        </div>
        <div class="flex justify-between w-full my-1">
          <div class="mx-1 w-1/2">
            <x-jet-label for="model_location">Ubicación</x-label>
            <select wire:model.defer="model_location_id">
                <option value="">Sin Definir</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="model_location_id" class="mt-1" />
          </div>
        </div>
      </x-slot>
      <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('editModal')">
          Cancelar
        </x-jet-secondary-button>
        @if ($model_id == null)
          <x-jet-danger-button class="ml-2" wire:click="saveNewItem()">
            Crear
          </x-jet-danger-button>
        @else
          <x-jet-button class="ml-2" wire:click="saveEdit({{ $model_id }})">
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
          <tr class="text-xs uppercase text-center">
            <th class="px-4 py-2"><x-svg.user /></th>
            <th class="px-4 py-2"><x-svg.location /></th>
            <th class="px-4 py-2"><x-svg.phone /></th>
            <th class="px-4 py-2"><x-svg.email /></th>
            <th class="px-4 py-2"><x-svg.gear class="mx-auto" /></th>
          </tr>
        </thead>
        <tbody class="bg-gray-100">
          @foreach ($records as $record)
            <tr class="text-left text-gray-900">
              <td class="border-2 px-4 py-2">{{ $record->name }}</td>
              <td class="border-2 px-4 py-2">{{ $record->address }}</td>
              <td class="border-2 px-4 py-2">{{ $record->phone }}</td>
              <td class="border-2 px-4 py-2">{{ $record->email }}</td>
              <td class="border-2 px-4 py-2 w-14">
                  <div class="flex">
                <button type="button" wire:click='edit({{ $record->id }})'
                  class="flex bg-indigo-600 text-white w-full px-4 py-1 rounded-l shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out items-center">
                  <x-svg.edit class="h-5 w-5" />
                </button>
                <button type="button" wire:click='deleteItem({{ $record->id }})'
                  class="flex bg-red-600 text-white w-full px-4 py-1 shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out items-center">
                  <x-svg.trash class="h-5 w-5" />
                </button>
                {{-- PIN OPERATOR --}}
                <button type="button" wire:click='pin({{ $record->id }})'
                  class="flex bg-green-600 text-white w-full px-4 py-1 rounded-r shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out items-center">
                  <x-svg.pin class="h-5 w-5" />
                </button>
              </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  