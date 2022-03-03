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
        Eliminar
      </x-jet-danger-button>
    </x-slot>
  </x-jet-dialog-modal>

  {{-- jetstream modal to edit equipment --}}
  <x-jet-dialog-modal wire:model="editModal">
    <x-slot name="title">Editar Ubicación » <small>#{{ $location_id }}</small></x-slot>
    <x-slot name="content">
      <div class="flex justify-between w-full my-1">
        <div class="w-1/3 mx-1">
          <x-jet-label for="location_name">Nombre</x-label>
            <x-jet-input type="text" wire:model.defer="location_name" maxlength="60" />
            <x-jet-input-error for="location_name" class="mt-1" />
        </div>
        <div class="w-2/3 mx-2">
          <x-jet-label for="location_address">Dirección</x-label>
            <x-jet-input type="text" wire:model.defer="location_address" maxlength="60" />
            <x-jet-input-error for="location_address" class="mt-1" />
        </div>
      </div>
      <div class="flex justify-between w-full my-1">
        <div class="w-1/2 mx-1">
          <x-jet-label for="location_phone">Celular</x-label>
            <x-jet-input type="text" wire:model.defer="location_phone" maxlength="60" />
            <x-jet-input-error for="location_phone" class="mt-1" />
        </div>
        <div class="w-1/2 mx-1">
          <x-jet-label for="location_email">Email</x-label>
            <x-jet-input type="email" wire:model.defer="location_email" maxlength="60" />
            <x-jet-input-error for="location_email" class="mt-1" />
        </div>
      </div>
    </x-slot>
    <x-slot name="footer">
      <x-jet-secondary-button wire:click="$toggle('editModal')">
        Cancelar
      </x-jet-secondary-button>
      @if ($location_id == null)
        <x-jet-danger-button class="ml-2" wire:click="saveNewItem()">
          Crear
        </x-jet-danger-button>
      @else
        <x-jet-button class="ml-2" wire:click="saveEdit({{ $location_id }})">
          Guardar
        </x-jet-button>
      @endif
    </x-slot>
  </x-jet-dialog-modal>

  <div class="flex flex-wrap justify-around px-6">
    <div class="flex w-3/4">
      <input type="search" placeholder="Buscar..." wire:model.defer="search" wire:keypress.enter="searchRecords"
        class="w-full rounded-l-md" />
      <button wire:click="searchRecords" class="justify-center bg-gray-200 w-14 rounded-r-md hover:bg-gray-100">
        <x-svg.search class="w-6 h-6 m-auto" />
      </button>
    </div>

    @if (Auth::user()->role == 'admin')
      <div class="flex justify-end w-1/4 my-1">
        <button type="button" wire:click='create()'
          class="flex items-center px-4 py-1 text-xs font-medium text-white uppercase transition duration-150 ease-in-out bg-indigo-600 rounded shadow-md w-36 hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>&nbsp;
          Agregar
        </button>
      </div>
    @endif

    <table class="w-full overflow-hidden rounded-md shadow-md table-auto">
      <thead class="text-gray-100 bg-gray-900">
        <tr class="text-xs uppercase">
          <th class="px-4 py-2">Nombre</th>
          <th class="px-4 py-2">Dirección</th>
          <th class="px-4 py-2">Celular</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Acciones</th>
        </tr>
      </thead>
      <tbody class="bg-gray-100">
        @foreach ($locations as $location)
          <tr class="text-left text-gray-900">
            <td class="px-4 py-2 border-2">{{ $location->name }}</td>
            <td class="px-4 py-2 border-2">{{ $location->address }}</td>
            <td class="px-4 py-2 border-2">{{ $location->phone }}</td>
            <td class="px-4 py-2 border-2">{{ $location->email }}</td>
            <td class="px-4 py-2 border-2 w-14">
              <div class="flex">
                <button type="button" wire:click='edit({{ $location->id }})'
                  class="flex items-center w-full px-4 py-1 text-white transition duration-150 ease-in-out bg-indigo-600 rounded-l shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg">
                  <x-svg.edit class="w-5 h-5" />
                </button>
                <button type="button" wire:click='deleteItem({{ $location->id }})'
                  class="flex items-center w-full px-4 py-1 text-white transition duration-150 ease-in-out bg-red-600 shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg">
                  <x-svg.trash class="w-5 h-5" />
                </button>
                {{-- pin location --}}
                <button type="button" wire:click='pinLocation({{ $location->id }})'
                  class="flex items-center w-full px-4 py-1 text-white transition duration-150 ease-in-out bg-green-600 rounded-r shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg">
                  <x-svg.pin class="w-5 h-5" />
                </button>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
