<div>
  <div class="flex text-white text-xsm w-full p-1 items-center bg-gray-800 opacity-70 bg-opacity-50">
    @if ($notified)
      <button wire:click="$toggle('notified')" class="rounded-full border p-1 transition-all animate-pulse">
        <x-svg.pin />
      </button>
    @else
      <button wire:click="$toggle('notified')" class="rounded-full border p-1">
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
      <p class="mr-2"><x-svg.operator class="inline-block" /> {{ Session::get('operator')->name }}</p>
    @endif
    @if (Session::has('message'))
      <p class="mr-2"><x-svg.chat class="inline-block" /> {{ Session::get('message') }}</p>
    @endif
      </div>
  </div>
</div>
