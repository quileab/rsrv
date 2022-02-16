<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    //relationships belongs to a location
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    //relationships many to many with treatments
    public function treatments()
    {
        return $this->belongsToMany('App\Models\Treatment');
    }
}
