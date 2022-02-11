<div>
  {{-- jetstream modal to confirm deletion --}}
  <x-jet-dialog-modal wire:model="confirm.show">
    <x-slot name="title">
      {{ $confirm['title'] }}
    </x-slot>

    <x-slot name="content">
      {{ $confirm['question'] }}
    </x-slot>

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
  <x-jet-dialog-modal wire:model="edit">
    <x-slot name="title">
      Editar Equipo
    </x-slot>

    <x-slot name="content">
      //TODO: edit equipment
    </x-slot>
    <x-slot name="footer">
      <x-jet-secondary-button wire:click="$toggle('edit')">
        Cancelar
      </x-jet-secondary-button>

      <x-jet-danger-button class="ml-2" wire:click="edit">
        Guardar
      </x-jet-danger-button>
    </x-slot>
  </x-jet-dialog-modal>

  <div class="flex flex-wrap justify-around">
    @foreach ($equipment as $item)
      <div class="w-48 max-w-sm m-3 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg">
        <a href="#!">
          <img class="h-32 rounded-t-lg" src="{{ $item->image_path }}" alt="{{ $item->description }}" />
        </a>
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
                class="bg-blue-600 text-white inline-block px-3 py-1 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
              </button>
              {{-- button to delete card --}}
              <button type="button" wire:click='confirmDelete({{ $item->id }})'
                class="bg-red-600 text-white inline-block px-3 py-1 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
            </div>
          @endif

        </div>
      </div>

    @endforeach
  </div>

</div>
