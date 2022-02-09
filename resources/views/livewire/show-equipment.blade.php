<div>
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

        </div>
      </div>

    @endforeach
  </div>

</div>
