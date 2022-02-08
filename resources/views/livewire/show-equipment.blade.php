<div>
  <div class="flex justify-around flex-wrap">
    @foreach ($equipment as $item)

      <div class="m-3 rounded-lg shadow-lg w-48 max-w-sm bg-white border border-gray-200 overflow-hidden">
        <a href="#!">
          <img class="rounded-t-lg h-32" src="{{ $item->image_path }}" alt="{{ $item->description }}" />
        </a>
        <div class="p-4">
          <h5 class="text-gray-900 text-lg w-full h-7 font-medium overflow-clip">{{ $item->name }}</h5>
          <p class="text-gray-700 text-sm mb-4 h-20 text-ellipsis overflow-hidden ...">
            {{ $item->description }}
          </p>

          <button type="button" wire:click='reserve({{ $item->id }})'
            class="bg-indigo-600 text-white w-full inline-block px-6 py-2.5 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out">
            Reservar
          </button>

        </div>
      </div>

    @endforeach
  </div>

</div>
