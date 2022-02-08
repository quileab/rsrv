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
}
