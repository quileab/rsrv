<div class="mx-5">
    <div class="w-full flex">
        <div class="h-20 lg:h-auto lg:w-32 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" 
            style="background-image: url('{{$equipment->image_path}}')" title="{{$equipment->name}}">
        </div>
        <div class="border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
          <div class="mb-2">
            <div class="text-black font-bold text-xl mb-2">{{$equipment->name}}</div>
            <p class="text-grey-darker text-base">
                {{$equipment->description}}
            </p>
          </div>
        </div>
      </div>

      <div>
        <x-jet-label>Fecha desde
        <x-jet-input type="date" wire:model="startDate" required autofocus />
        <x-jet-input type="time" wire:model="startTime" required autofocus />
        </x-jet-label>
        <x-jet-label>Fecha hasta
        <x-jet-input type="date" wire:model="endDate" required />
        <x-jet-input type="time" wire:model="endTime" required />
        </x-jet-label>
      </div>



    {!! $calendar !!}
</div>
