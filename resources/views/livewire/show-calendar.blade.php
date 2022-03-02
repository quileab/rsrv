<div class="mx-5">

  {{-- jetstream modal, daily booking selection --}}
  <x-jet-dialog-modal wire:model="dayModal">
    <x-slot name="title">Agenda del día {{ Carbon\Carbon::parse($daySelected)->format('d M') }}</x-slot>
    <x-slot name="content">
      <select wire:model="equipment_treatment" class="rounded-md">
        @foreach ($equipment_treatments as $treatment)
          <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
        @endforeach
      </select>
      Duración: {{ $selected_treatment->duration ?? 0 }} minutos
      <select>
        @foreach ($availSlots as $avail)
          <option>{{ $avail['start'] }} ({{ $avail['diff'] }}min.)</option>
        @endforeach
      </select>
      <table class="table table-sm table-hover">
        <thead>
          <tr>
            <th>Hora</th>
            <th>Cliente</th>
            <th>Servicio</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($daySlots as $slot)
            <tr class="{{ $slot['booked'] ? 'active' . $slot['bgcolor'] : '' }}">
              <td class="text-center {{ $slot['pickable'] ? 'bg-green-900 bg-opacity-20' : '' }}">
                @if ($slot['pickable'])
                  <button wire:click="bookCustomerTreatment('{{ $slot['time'] }}')">
                @endif
                {{ $slot['time'] }}
                @if ($slot['pickable'])
                  </button>
                @endif


                {{ $slot['booked'] == true ? ' a ' . $slot['ends'] : '' }}
              </td>
              <td>{{ $slot['booked'] == true ? $slot['customer'] : '' }}</td>
              <td>
                {{ $slot['booked'] == true ? $slot['treatment'] : '' }}</td>
              <td>
                <button type="submit" class="btn btn-sm btn-danger">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </x-slot>
    <x-slot name="footer">
      <x-jet-secondary-button wire:click="$toggle('dayModal')">
        Cancelar
      </x-jet-secondary-button>
      <x-jet-danger-button class="ml-2" wire:click="bookCustomerTreatment()">
        <x-svg.check class="w-5 h-5" />&nbsp;Agendar
      </x-jet-danger-button>
    </x-slot>
  </x-jet-dialog-modal>


  <div class="flex w-full my-4 shadow-md">
    @if (stripos($equipment->image_path, 'http') === 0)
      <div
        class="flex-none h-20 overflow-hidden text-center bg-cover rounded-t lg:h-auto lg:w-32 lg:rounded-t-none lg:rounded-l"
        style="background-image: url('{{ $equipment->image_path }}')" title="{{ $equipment->name }}">
      </div>
    @else
      <div
        class="flex-none h-20 overflow-hidden text-center bg-cover rounded-t lg:h-auto lg:w-32 lg:rounded-t-none lg:rounded-l"
        style="background-image: url('{{ Storage::url($equipment->image_path) }}')"
        title="{{ $equipment->name }}">
      </div>
    @endif

    <div
      class="flex flex-col justify-between w-full p-4 leading-normal bg-white border-b border-l border-r rounded-b border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light lg:rounded-b-none lg:rounded-r">
      <div class="mb-2 text-xl font-bold text-black">{{ $equipment->name }}</div>
      <p class="text-base text-grey-darker">
        {{ $equipment->description }}
      </p>
    </div>
  </div>

  <div class="flex w-full p-3 my-2 bg-white rounded shadow-md">
    <div class="inline-block w-1/2 sm:w-1/3">
      <x-jet-label>Fecha desde</x-jet-label>
      <x-jet-input type="date" wire:model="startDate" required class="w-full" />
      {{-- <x-jet-input type="time" wire:model="startTime" required /> --}}
      <x-jet-label>Fecha hasta</x-jet-label>
      <x-jet-input type="date" wire:model="endDate" required class="w-full" />
      {{-- <x-jet-input type="time" wire:model="endTime" required /> --}}
    </div>
    <div class="inline-block w-1/2 sm:w-2/3">
      @if ($available)
        <button
          class="px-6 py-2 mx-2 mt-6 text-xs text-white bg-purple-700 rounded hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-600"
          wire:click="bookIn()">
          Registrar Fechas
        </button>
      @else
        <button
          class="px-6 py-2 mx-2 mt-6 text-xs text-white bg-indigo-700 rounded hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600"
          wire:click="checkAvailability()">
          Verificar Disponibilidad
        </button>
      @endif
      @if ($message)
        <div class="px-3 py-3 m-2 text-sm bg-blue-100">{{ $message }}</div>
      @endif
    </div>
  </div>

  <div class="flex py-3 justify-evenly">
    <div>
      {!! $calendar !!}
    </div>

    <div>
      <table class="my-3 bg-white shadow-md">
        <thead>
          <tr>
            <th>Inicio</th>
            <th>Final</th>
            <th>Registrado por</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bookings as $book)
            <tr>
              <td>{{ Carbon\Carbon::createFromDate($book->start_date)->format('d-m-Y') }}</td>
              <td>{{ Carbon\Carbon::createFromDate($book->end_date)->format('d-m-Y') }}</td>
              <td>{{ $book->user->name }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>
