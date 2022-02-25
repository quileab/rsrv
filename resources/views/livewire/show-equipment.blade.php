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


    <x-slot name="title">Editar Equipo » <small>#{{ $equip_id }}</small>
    </x-slot>
    <x-slot name="content">

        <div class="flex justify-between w-full">
          <div class="w-1/3 mx-1">
            <x-jet-label for="equip_name">Nombre</x-label>
              <x-jet-input type="text" wire:model.defer="equip_name" maxlength="60" />
              <x-jet-input-error for="equip_name" class="mt-1" />
          </div>
          <div class="w-2/3 mx-2">
            <x-jet-label for="equip_description">Descripción</x-label>
              <textarea wire:model.defer="equip_description" maxlength="250"
                class="w-full" />{{ $equip_description }}</textarea>
              <x-jet-input-error for="equip_description" class="mt-1" />
          </div>
        </div>
        <div class="flex justify-between w-full my-1">
          <div class="mx-1 w-1/2">
            <x-jet-label for="equip_serial_number">Número de Serie</x-label>
              <x-jet-input type="text" wire:model.defer="equip_serial_number" maxlength="60" />
              <x-jet-input-error for="equip_serial_number" class="mt-1" />
          </div>
          <div class="mx-1 w-1/2">
            <x-jet-label for="equip_model">Modelo</x-label>
              <x-jet-input type="text" wire:model.defer="equip_model" maxlength="60" />
              <x-jet-input-error for="equip_model" class="mt-1" />
          </div>
        </div>
        <div class="flex justify-between w-full my-1">
          <div class="mx-1 w-1/2">
            <x-jet-label for="equip_manufacturer">Fabricante</x-label>
              <x-jet-input type="text" wire:model.defer="equip_manufacturer" />
              <x-jet-input-error for="equip_manufacturer" class="mt-1" />
          </div>
          <div class="mx-1 w-1/2">
            <x-jet-label for="equip_location_id">Ubicación</x-label>
              <select wire:model.defer="equip_location_id">
                <option value="">Sin Definir</option>
                @foreach ($locations as $location)
                  <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
              </select>
              <x-jet-input-error for="equip_location_id" class="mt-1" />
          </div>
        </div>
        <div class="flex justify-between w-full my-1">
          <div class="mx-1 w-1/2 border shadow-md overflow-clip p-2 bg-violet-200">
            <div class="flex justify-between">

              <button wire:click="$toggle('imageSelect')"
                class="text-sm bg-purple-500 hover:bg-purple-700 text-white font-bold py-1 px-3 rounded-md h-11">
                Cambiar Imagen
              </button>

              @if ($image != null)
                <img class="w-32" src="{{ $image->temporaryUrl() }}" alt="equipment image">
              @else
                @if (stripos($equip_image_path, 'http') === 0)
                  <img class="w-32" src="{{ $equip_image_path }}" alt="{{ $equip_description }}" />
                @else
                  <img class="w-32" src="{{ Storage::url($equip_image_path) }}"
                    alt="{{ $equip_description }}" />
                @endif
              @endif
            </div>
            @if ($imageSelect)
              <x-jet-input type="text" wire:model.defer="equip_image_path" maxlength="240" class="w-full text-sm" />
              <x-jet-input-error for="equip_image_path" class="mt-1" />

              <x-jet-input
                class="form-control block w-full text-base font-normal
              text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-blue-700 focus:border-blue-600 focus:outline-none"
                type="file" wire:model="image" />
              @error('image')
                <span class="error">{{ $message }}</span>
              @enderror

              <div wire:loading wire:target="image" class="inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 animate-spin"
                  viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                  <path
                    d="M10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 4a4 4 0 0 0-4 4 .5.5 0 0 1-1 0 5 5 0 0 1 5-5 .5.5 0 0 1 0 1zm4.5 3.5a.5.5 0 0 1 .5.5 5 5 0 0 1-5 5 .5.5 0 0 1 0-1 4 4 0 0 0 4-4 .5.5 0 0 1 .5-.5z" />
                </svg> Cargando...
              </div>
            @endif
          </div>

          <div class="mx-1 w-1/2 p-2">

            <x-jet-label for="equip_price">Precio <small>(por día)</small></x-jet-label>
            <x-jet-input type="number" wire:model.defer="equip_price" min="0" step=".01" />
            <x-jet-input-error for="equip_price" class="mt-1" />
            <div class="flex items-center mt-2">
              <x-jet-label for="equip_status">Estado&nbsp;</x-jet-label>
              <select wire:model.defer="equip_status" class="border bg-white rounded pl-2 pr-5 py-1 outline-none">
                <option value="">Activo</option>
                <option value="0">Inactivo</option>
              </select>
              <x-jet-input-error for="equip_status" class="mt-1" />
            </div>
          </div>
        </div>

    </x-slot>
    <x-slot name="footer">
      <x-jet-secondary-button wire:click="$toggle('editModal')">
        Cancelar
      </x-jet-secondary-button>
      @if ($equip_id == null)
        <x-jet-danger-button class="ml-2" wire:click="saveNewEquipment()">
          Crear Equipo
        </x-jet-danger-button>
      @else
        <x-jet-button class="ml-2" wire:click="saveEdit({{ $equip_id }})">
          Guardar
        </x-jet-button>
      @endif

    </x-slot>
  </x-jet-dialog-modal>

  <div class="flex flex-wrap justify-around">
    @if (Auth::user()->role == 'admin')
      {{-- botón nuevo equipo --}}
      <div class="w-48 max-w-sm m-3 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg">
        <img class="h-32 rounded-t-lg" src="{{ asset('img\1299218539-612x612.jpg') }}" alt="Nuevo equipo" />
        <div class="p-4">
          <h5 class="w-full text-lg font-medium text-gray-900 h-7 overflow-clip">Nuevo Equipo</h5>
          <p class="text-gray-700 text-sm mb-4 h-20 text-ellipsis overflow-hidden ...">
            Agregar un nuevo equipo a la lista de equipos.
          </p>

          <button type="button" wire:click='create()'
            class="flex bg-indigo-600 text-white w-full px-6 py-2.5 font-medium text-xs uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>&nbsp;
            Agregar
          </button>
        </div>
      </div>
    @endif

    @foreach ($equipment as $item)
      <div class="w-48 max-w-sm m-3 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg">
        @if (stripos($item->image_path, 'http') === 0)
          <img class="h-32 rounded-t-lg" src="{{ $item->image_path }}" alt="{{ $item->description }}" />
        @else
          <img class="h-32 rounded-t-lg" src="{{ Storage::url($item->image_path) }}"
            alt="{{ $item->description }}" />
        @endif
        <div class="p-4">
          <h5 class="w-full text-lg font-medium text-gray-900 h-7 overflow-clip">{{ $item->name }}</h5>
          <p class="text-gray-700 text-sm mb-4 h-20 text-ellipsis overflow-hidden ...">
            {{ $item->description }}
          </p>

          <button type="button" wire:click='reserve({{ $item->id }})'
            class="bg-indigo-600 text-white w-full inline-block px-6 py-2.5 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out">
            Reservar
          </button>
          @if (Auth::user()->role == 'admin')
            {{-- button to edit card --}}
            <div class="flex w-full mt-1 text-center justify-evenly">
              <button type="button" wire:click='edit({{ $item->id }})'
                class="inline-block px-3 py-1 text-xs font-medium leading-tight text-white uppercase transition duration-150 ease-in-out bg-blue-600 rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
              </button>
              {{-- button to delete card --}}
              <button type="button" wire:click='confirmDelete({{ $item->id }})'
                class="inline-block px-3 py-1 text-xs font-medium leading-tight text-white uppercase transition duration-150 ease-in-out bg-red-600 rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
            </div>
          @endif

        </div>
      </div>
    @endforeach
  </div>

</div>
