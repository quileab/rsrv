<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class ShowCalendar extends Component
{
    public $dt=null;
    public $calendar=null;
    public $equipment=null;

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


    private function renderCalendar($dt) {
        // Make sure to start at the beginnen of the month
        $dt->startOfMonth();
        
        // Set the headings (weeknumber + weekdays)
        $headings = ['Semana', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
    
        // Create the table
        $calendar = '<table class="calendar">';
        $calendar .= '<caption>'.$dt->formatLocalized('%B').' » '.$dt->format('Y').'</caption>';
        $calendar .= '<thead><tr>';
    
        // Create the calendar headings
        foreach ($headings as $heading) {
            $calendar .= '<th class="header">'.$heading.'</th>';
        }
    
        // Create the rest of the calendar and insert the weeknumber
        $calendar .= '</tr></thead><tr>';
        $calendar .= '<td>'.$dt->weekOfYear.'</td>';
    
        // Day of week isn't monday, add empty preceding column(s)
        if ($dt->format('N') != 1) { 
            $calendar .= '<td colspan="'.($dt->format('N') - 1).'">&nbsp;</td>'; 
        }
    
        // Get the total days in month
        $daysInMonth = $dt->daysInMonth;
    
        // Go over each day in the month
        for ($i = 1; $i <= $daysInMonth; $i++) { 
            // Monday has been reached, start a new row
            if ($dt->format('N') == 1) {
                $calendar .= '</tr><tr>';
                $calendar .= '<td>'.$dt->weekOfYear.'</td>';
            }
            // Append the column
            $calendar .= '<td class="day" rel="'.$dt->format('Y-m-d').'">'.$dt->day.'</td>';
    
            // Increment the date with one day
            $dt->addDay();
        }
    
        // Last date isn't sunday, append empty column(s)
        if ($dt->format('N') != 7) {
            $calendar .= '<td colspan="'.(8 - $dt->format('N')).'">&nbsp;</td>'; 
        }
    
        // Close table
        $calendar .= '</tr>';
        $calendar .= '</table>';
    
        // Return calendar html
        return $calendar;
    }
    
}
