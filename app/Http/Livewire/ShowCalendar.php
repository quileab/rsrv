<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Booking;

class ShowCalendar extends Component
{
    public $now=null;
    public $calendar=null;
    public $unixCalendar=[];
    public $equipment=null;
    public $message=null;
    public $available=false;
    public $bookings=[];

    public $startDate;
    public $endDate;
    public $startTime="12:00";
    public $endTime="12:00";

    public function mount()
    {
        $this->startDate=Carbon::now()->format('Y-m-d');
        $this->endDate=Carbon::now()->addDays(7)->format('Y-m-d');
        $this->equipment=session('equipment');
        // pasar a carbon la fecha actual
        $this->now=Carbon::now();
        //$this->dt=Carbon::createFromDate(Carbon);
        $this->populateUnixCalendar();
        $this->calendar=$this->renderCalendar($this->now);
    }

    public function render()
    {
        return view('livewire.show-calendar',[
            'calendar'=>$this->calendar,
            'equipment'=>$this->equipment,
        ]);
    }

    public function updatedStartDate($startDate)
    {
        $this->message=null;
        $this->available=false;
        
        $today=Carbon::now();
        //if $startDate before today, set to today
        if($startDate<$today){
            $this->startDate=$today;
        }
    }

    public function updatedEndDate($endDate)
    {
        $this->message=null;
        $this->available=false;

        //if $endDate before $startDate, set to $startDate
        if($endDate<$this->startDate){
            $this->endDate=$this->startDate;
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
        $booking->start_date=$this->startDate.' '.$this->startTime;
        $booking->end_date=$this->endDate.' '.$this->endTime;
        $booking->status='pending';
        $booking->price=$this->equipment->price;
        $booking->save();
        // $this->reset('startDate','endDate');
        // refresh calendar
        $this->populateUnixCalendar();
        $this->calendar=$this->renderCalendar($this->now);
        $this->render();
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
        //dd($lastBookedDate, isset($lastBookedDate->status));
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
            $calendar="<h3 class='w-full p-3 mx-auto text-center text-lg font-bold'>No hay reservas</h3>";
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
                $calendar .= '<td class="day '.$this->unixCalendar[$month->format('Ymd')].'" rel="'.$month->format('Y-m-d').'">'.$month->day.'</td>';
    
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
