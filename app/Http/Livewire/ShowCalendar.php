<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use Livewire\Component;
use App\Models\Treatment;
use Illuminate\Support\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Session;

class ShowCalendar extends Component
{
    public $now=null;
    public $calendar=null;
    public $unixCalendar=[];
    public $equipment=null;
    public $selected_treatment=null;
    public $message=null;
    public $bookings=[];
    public $dayModal=false;
    public $equipment_treatments=[];
    // available enables the user to book dates
    public $available=false;

    public $startDate;
    public $endDate;
    public $daySelected;
    public $daySlots=[];

    public $equipment_treatment=null; // helper select-options

    public $rules=[
        'startDate'=>'required|date',
        'endDate'=>'required|date',
        'equipment_treatment'=>'required',
    ];

    public function mount()
    {
        if (Session::has('equipment')) {
            $this->equipment=session('equipment');
            $this->equipment_treatments=$this->equipment->treatments()->get();
            $this->equipment_treatment=$this->equipment_treatments[0];
            $this->selected_treatment=$this->equipment_treatments[0];
            //$this->updatedEquipmentTreatment($this->equipment_treatment);
        }else{
            //redirect to equipment page
            return redirect()->route('equipment');
        }
        $this->startDate=Carbon::now()->format('Y-m-d');
        $this->endDate=Carbon::now()->addDays(7)->format('Y-m-d');
        $this->populateUnixCalendar();
        $this->calendar=$this->renderCalendar(Carbon::now());
    }

    public function render(){
        return view('livewire.show-calendar',[
            'calendar'=>$this->calendar,
            'equipment'=>$this->equipment,
            'availSlots'=>$this->checkAvailableSlots(),
        ]);
    }

    public function createDaySlots($date){
        // create day array parsed every 5 minutes 
        // starting from 00:00 until 23:55
        // Fills with bookings
        $datePicked=Carbon::parse($date);
        $start=Carbon::parse($date.' 07:00');
        $finish=Carbon::parse($date.' 21:00');
        $interval=CarbonInterval::minutes(5);

        // get all the bookings for the day for the equipment
        $bookings=\App\Models\Booking::where('equipment_id',$this->equipment->id)
            // customer_id not null
            ->whereNotNull('customer_id')
            ->where('start_date','>=',$datePicked->format('Y-m-d'))
            ->get();

        $day=[]; $record_count=0;
        while($start<=$finish){
            // check if $start is in bookings start_date and end_date
            $booked=0;
            foreach($bookings as $booking){
                if($booking->start_date<=$start && $booking->end_date>=$start){
                    $booked=$booking->id;
                    break;
                }
            }

            if($booked){
                $record_count++;
                $day[$start->format('H:i')]=[
                    'time'=>$start->format('H:i'),
                    'ends'=>Carbon::parse($booking->end_date)->format('H:i'),
                    'booked'=>$booked,
                    'bgcolor'=>($record_count % 4)+1,
                    'customer'=>\App\Models\Customer::find($booking->customer_id)->name,
                    'treatment'=>\App\Models\Treatment::find($booking->treatment_id)->name,
                    'pickable'=>false,
                    ];
                    // set the start time to the end of the booking
                    $start=Carbon::parse($booking->end_date);
            }else{
                $day[$start->format('H:i')]=[
                    'time'=>$start->format('H:i'),
                    'ends'=>null,
                    'booked'=>$booked,
                    'bgcolor'=>0,
                    'customer'=>null,
                    'treatment'=>null,
                    'pickable'=>false,
                ];
            }
            $start->add($interval);
        }
        $this->daySelected=$datePicked->copy();
        $this->daySlots=$day;
        $this->dayModal=true;
    }

    // automatic Livewire update function
    public function updatedStartDate($startDate){
        $this->message=null;
        $this->available=false;
        
        $today=Carbon::now();
        //if $startDate before today, set to today
        if($startDate<$today){
            $this->startDate=$today;
        }
    }
    // automatic Livewire update function
    public function updatedEndDate($endDate){
        $this->message=null;
        $this->available=false;

        //if $endDate before $startDate, set to $startDate
        if($endDate<$this->startDate){
            $this->endDate=$this->startDate;
        }
    }

    public function checkAvailableSlots(){ 
        // check if treatment is selected
        if($this->selected_treatment=='null'){
            $this->emitTo('livewire-toast','showError','Seleccione un Tratamiento');
            return false;
        }
        //returns an array of available slots
        $slotStart=null;
        $slotEnd=null;
        $freeSlots=[];
        foreach($this->daySlots as $slot){
            if($slotStart==null){
                $slotStart=$slot['time'];
            }
            $slotEnd=$slot['time'];

            if($slot['ends']!=null){
                $freeSlots[]=[
                    'start'=>$slotStart,
                    //'ends'=>$slotEnd,
                    'ends'=>Carbon::parse($slotEnd)->subMinutes($this->selected_treatment->duration)->format('H:i'),
                    'diff'=>Carbon::parse($slotEnd)->diffInMinutes(Carbon::parse($slotStart)),
                ];
                $slotStart=null;
                $slotEnd=null;
            }
        }
        // add the last slot if it is started
        if ($slotStart!=null) {
            $freeSlots[]=[
                'start'=>$slotStart,
                // ends is slotend minus seleted_treatment->duration
                'ends'=>Carbon::parse($slotEnd)->subMinutes($this->selected_treatment->duration)->format('H:i'),
                'diff'=>Carbon::parse($slotEnd)->diffInMinutes(Carbon::parse($slotStart)),
            ];
        }
        // delete from $freeSlots those slots that end is before start
        $freeSlots2=[];
        foreach($freeSlots as $slot){
            if($slot['ends']>$slot['start']){
                $freeSlots2[]=$slot;
            }
        }
        return $freeSlots2;
    }

    public function updatedEquipmentTreatment($equipment_treatment){
        if ($equipment_treatment=='null') {
            $this->emitTo('livewire-toast','showError','Seleccione un Tratamiento');
            $this->available=false;
            return;
        }
        // Recreate Dayslots and populate with bookings
        $this->createDaySlots($this->daySelected->format('Y-m-d'));
        $this->selected_treatment=Treatment::find($equipment_treatment);
        // check for available slots
        $available=$this->checkAvailableSlots();

        if (count($available)>0) {
            // set daySlots['pickable'] to true
            foreach ($available as $avail) {
                // for every 5 minutes from start to end set pickable to true
                $start=Carbon::parse($avail['start']);
                $end=Carbon::parse($avail['ends']);
                $interval=CarbonInterval::minutes(5);
                while ($start<=$end) {
                    $this->daySlots[$start->format('H:i')]['pickable']=true;
                    $start->add($interval);
                }
            }
        }
    }

    public function checkAvailability(){
        if ($this->startDate>$this->endDate){
            // switch dates
            $temp=$this->startDate;
            $this->startDate=$this->endDate;
            $this->endDate=$temp;
        }
        $this->message=null;
        // Check if there are any bookings for the current months range
        $exists = Booking::where('equipment_id', $this->equipment->id)
        ->where('customer_id',null)
        ->byBusy($this->startDate, $this->endDate)
        ->get();
        if(count($exists)>0){
            $this->message="No hay disponibilidad en el rango de fechas seleccionado";
            $this->available=false;
            $this->bookings=$exists;
        }
        else{
            $this->message="Fechas disponibles para reservar";
            $this->available=true;
            $this->bookings=[];
        }
    }

    public function bookIn(){
        $this->message=null;
        $this->available=false;
        // register booking
        $booking=new Booking();
        $booking->equipment_id=$this->equipment->id;
        $booking->user_id=auth()->user()->id;
        $booking->start_date=$this->startDate.' 12:00';
        $booking->end_date=$this->endDate.' 12:00';
        $booking->status='pending';
        $booking->price=$this->equipment->price;
        $booking->save();
        // $this->reset('startDate','endDate');
        // refresh calendar
        $this->populateUnixCalendar();
        $this->calendar=$this->renderCalendar(Carbon::now());
    }

    public function bookCustomer($date){
        if (!Session::has('customer')) {
            $this->emitTo('livewire-toast','showError','Seleccione un Cliente');
            return;
        }
        $this->createDaySlots($date);
    }

    public function bookCustomerTreatment($start){
        //dd($this->equipment_treatment);
        if (!Session::has('customer')) {
            $this->emitTo('livewire-toast','showError','Seleccione un Cliente');
            return;
        }
        if ($this->equipment_treatment=='null') {
            $this->emitTo('livewire-toast','showError','Seleccione un Tratamiento');
            $this->available=false;
            return;
        }
        if (!$this->selected_treatment) {
            $this->emitTo('livewire-toast','showError','Seleccione un Tratamiento');
            return;
        }

        $end=Carbon::parse($start)->addMinutes($this->selected_treatment->duration)->format('H:i');

        $booking=new Booking();
        $booking->equipment_id=$this->equipment->id;
        $booking->treatment_id=$this->selected_treatment->id;
        $booking->customer_id=Session::get('customer')->id;
        $booking->user_id=auth()->user()->id;
        $booking->start_date=$this->daySelected->format('Y-m-d').' '.$start;
        $booking->end_date=$this->daySelected->format('Y-m-d').' '.$end;
        $booking->status='pending';
        $booking->price=$this->selected_treatment->price;
        if (Session::has('operator')) {
            $booking->operator_id=Session::get('operator')->id;
            $booking->operator_price=$this->selected_treatment->operatorPrice;
        }else{
            $booking->operator_id=null;
            $booking->operator_price=0;
        }

        $booking->save();

        $this->updatedEquipmentTreatment($this->equipment_treatment);
    }

    public function cancelCustomerBooking($id){
        //dd($this->daySelected) if a Carbon instance
        $booking=Booking::find($id);
        // delete record from database
        $booking->delete();
        // refresh calendar
        $this->createDaySlots($this->daySelected->format('Y-m-d'));
    }

    private function populateUnixCalendar() {
        // Make sure to start at the beginnen of the month
        $now=Carbon::now()->startOfMonth();
        // Get last booked date
        $lastBookedDate=Booking::lastBookedDate($this->equipment->id);
        // If there are no bookings, set $lastBookedDate to now
        if(!isset($lastBookedDate->status)){
            return;
        }        
        $lastBookedDate=Carbon::parse($lastBookedDate->end_date);
        // get last day of month of $lastBookedDate
        $lastBookedDate=$lastBookedDate->endOfMonth();
        
        $this->unixCalendar=[];

        // Loop through all days of the month starting from $now to $lastBookedDate
        $startDate=$now->copy();
        for ($i = $startDate; $i->lte($lastBookedDate); $i->addDay()) {
            // Add the current day to the unixCalendar
            $this->unixCalendar[$i->format('Ymd')] = 'free';
        }

        // Check if there are any bookings for the current months range
        $exists = Booking::where('equipment_id', $this->equipment->id)
            ->where('customer_id',null)
            ->byBusy($now->toDateString(), $lastBookedDate->toDateString())
            ->get();

        foreach ($exists as $ex) {
            $start_check = Carbon::parse($ex->start_date);
            $end_check = Carbon::parse($ex->end_date);

            // Loop through all days of the month starting from $start to $end
            for ($i = $start_check; $i->lte($end_check); $i->addDay()) {
                // Add the current day to the calendar
                $this->unixCalendar[$i->format('Ymd')] = 'booked';
            }
        }
    }

    private function renderCalendar($now) {
        $showWeek=false;
        $calendar='';
        // Make sure to start at the beginnen of the month
        $now->startOfMonth();
        $lastBookedDate=Booking::lastBookedDate($this->equipment->id);
        if (!isset($lastBookedDate->status)){
            $calendar="<h3 class='w-full p-3 mx-auto text-lg font-bold text-center text-white'>No hay reservas</h3>";
            return $calendar;
        }
        $lastBookedDate=Carbon::parse($lastBookedDate->end_date);
        // get last day of month of $lastBookedDate
        $lastBookedDate=$lastBookedDate->endOfMonth();
        
        // Set the headings (weeknumber + weekdays)
        if ($showWeek) {
            $headings = ['Semana', 'Lun','Mar','Mie','Jue','Vie','Sab','Dom'];
        }else{
            $headings = ['Lun','Mar','Mie','Jue','Vie','Sab','Dom'];
        }

        // repeat each booked month
        for ($month=$now;$month->lte($lastBookedDate);$month->addWeek()) {
            $month->startOfMonth();
            // Create the table
            $calendar .= '<table class="bg-white shadow-md calendar">';
            $calendar .= '<caption>'.$month->formatLocalized('%B').' » '.$month->format('Y').'</caption>';
            $calendar .= '<thead><tr>';
    
            // Create the calendar headings
            foreach ($headings as $heading) {
                $calendar .= '<th class="header">'.$heading.'</th>';
            }
    
            // Create the rest of the calendar and insert the weeknumber
            $calendar .= '</tr></thead><tr>';
            if ($showWeek) {
                $calendar .= '<td>'.$month->weekOfYear.'</td>';
            }
    
            // Day of week isn't monday, add empty preceding column(s)
            if ($month->format('N') != 1) {
                $calendar .= '<td colspan="'.($month->format('N') - 1).'">&nbsp;</td>';
            }
    
            // Get the total days in month
            $daysInMonth = $month->daysInMonth;
    
            // Go over each day in the month
            for ($i = 1; $i <= $daysInMonth; $i++) {
                // Monday has been reached, start a new row
                if ($month->format('N') == 1) {
                    $calendar .= '</tr><tr>';
                    if ($showWeek) {
                        $calendar .= '<td>'.$month->weekOfYear.'</td>';
                    }
                }
                // Append the column
                $calendar .= '<td class="day '.$this->unixCalendar[$month->format('Ymd')].'" rel="'.$month->format('Y-m-d').'">'.
                '<button class="w-full h-full calendar" wire:click="bookCustomer(\''.$month->format('Y-m-d').'\')">'.
                    $month->day.
                '</button></td>';
    
                // Increment the date with one day
                $month->addDay();
            }
    
            // Last date isn't sunday, append empty column(s)
            if ($month->format('N') != 7) {
                $calendar .= '<td colspan="'.(8 - $month->format('N')).'">&nbsp;</td>';
            }
    
            // Close table
            $calendar .= '</tr>';
            $calendar .= '</table><br />';
        }
        // Return calendar html
        return $calendar;
    }
   
}
