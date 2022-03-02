<div>
  <div class="flex items-center w-full p-1 text-white bg-gray-800 bg-opacity-50 text-xsm opacity-70">
    @if ($notified)
      <button wire:click="$toggle('notified')" class="p-1 transition-all border rounded-full animate-pulse">
        <x-svg.pin />
      </button>
    @else
      <button wire:click="$toggle('notified')" class="p-1 border rounded-full">
        <x-svg.check />
      </button>
    @endif
    
    <div @class([
        'text-sm' => true,
        'hidden' => !$notified,
        'w-full' => $notified,
        'flex' => true,
        'ml-2' => true,
      ])>
    {{-- show sessions customer, equipment, location, operator, message --}}
    @if (Session::has('location'))
      <p class="mr-2"><x-svg.location class="inline-block" /> {{ Session::get('location')->name }}</p>
    @endif
    @if (Session::has('customer'))
      <p class="mr-2"><x-svg.user class="inline-block" /> {{ Session::get('customer')->name }}</p>
    @endif
    @if (Session::has('equipment'))
      <p class="mr-2"><x-svg.equipment class="inline-block" /> {{ Session::get('equipment')->name }}</p>
    @endif
    @if (Session::has('operator'))
    <button wire:click="clearOperator()">
      <p class="mr-2"><x-svg.operator class="inline-block" /> {{ Session::get('operator')->name }}</p>
    </button>
    @endif
    @if (Session::has('message'))
      <p class="mr-2"><x-svg.chat class="inline-block" /> {{ Session::get('message') }}</p>
    @endif
      </div>
  </div>
</div>
