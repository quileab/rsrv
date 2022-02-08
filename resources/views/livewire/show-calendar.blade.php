<div class="mx-5">
  <div class="flex w-full my-4 shadow-md">
    <div
      class="flex-none h-20 overflow-hidden text-center bg-cover rounded-t lg:h-auto lg:w-32 lg:rounded-t-none lg:rounded-l"
      style="background-image: url('{{ $equipment->image_path }}')" title="{{ $equipment->name }}">
    </div>
    <div
      class="flex flex-col justify-between p-4 leading-normal bg-white border-b border-l border-r rounded-b border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light lg:rounded-b-none lg:rounded-r">
      <div class="mb-2">
        <div class="mb-2 text-xl font-bold text-black">{{ $equipment->name }}</div>
        <p class="text-base text-grey-darker">
          {{ $equipment->description }}
        </p>
      </div>
    </div>
  </div>

  <div class="flex my-2 text-right">
    <x-jet-label class="ml-4">Fecha desde
      <x-jet-input type="date" wire:model="startDate" required autofocus />
      <x-jet-input type="time" wire:model="startTime" required />
    </x-jet-label>
    <x-jet-label class="ml-4">Fecha hasta
      <x-jet-input type="date" wire:model="endDate" required />
      <x-jet-input type="time" wire:model="endTime" required />
    </x-jet-label>
  </div>

  {!! $calendar !!}
</div>
