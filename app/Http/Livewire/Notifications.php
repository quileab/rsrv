<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Session\Session;
use Livewire\Component;

class Notifications extends Component
{
    public $notified=false;

    protected $listeners = ['notify' => 'notifySession'];
 
    public function notifySession()
    {
        $this->notified=true;
    }

    public function render()
    {
        return view('livewire.notifications',['notified'=>$this->notified]);
    }

    public function clearOperator()
    {
        session()->forget('operator');
    }
}
