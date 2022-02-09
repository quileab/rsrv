<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function scopeByBusy($query,$start_date,$end_date){ 
        return $query->whereBetween('start_date', [$start_date, $end_date]) 
            ->orWhereBetween('end_date', [$start_date, $end_date]) 
            ->orWhereRaw('? BETWEEN start_date and end_date', [$start_date]) 
            ->orWhereRaw('? BETWEEN start_date and end_date', [$end_date]); 
    }

    public function scopeLastBookedDate($query,$equipment_id){ 
        return $query->where('equipment_id',$equipment_id)->orderBy('end_date','desc')->first();
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function equipment(){
        return $this->belongsTo('App\Models\Equipment');
    }
}
