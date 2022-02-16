<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    //relationships many to many with equipment
    public function equipment()
    {
        return $this->belongsToMany('App\Models\Equipment');
    }
}
