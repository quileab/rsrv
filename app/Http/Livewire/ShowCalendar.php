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

    public $startDate;
    public $endDate;
    public $startTime="10:00";
    public $endTime="18:00";

    public function mount()
    {
        $this->startDate=Carbon::now()->format('Y-m-d');
        $this->endDate=Carbon::now()->addDays(7)->format('Y-m-d');
        $this->equipment=session('equipment');
        // pasar a carbon la fecha actual
        $this->dt=Carbon::now();
        //$this->dt=Carbon::createFromDate(Carbon);
        $this->populateUnixCalendar();
        $this->calendar=$this->renderCalendar($this->dt);
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
        $today=Carbon::now();
        //if $startDate before today, set to today
        if($startDate<$today){
            $this->startDate=$today;
        }
    }

    public function updatedEndDate($endDate)
    {
        //if $endDate before $startDate, set to $startDate
        if($endDate<$this->startDate){
            $this->endDate=$this->startDate;
        }
    }


    private function populateUnixCalendar() {
        // Make sure to start at the beginnen of the month
        $now=Carbon::now()->startOfMonth();
        // Get last booked date
        $lastBookedDate=Booking::lastBookedDate($this->equipment->id);
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
            $calendar .= '<table class="calendar">';
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
            $calendar .= '</table>';
        }
        // Return calendar html
        return $calendar;
    }
    
}
