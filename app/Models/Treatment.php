<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    //relationships many to many with equipments
    public function equipments()
    {
        return $this->belongsToMany('App\Models\Equipment');
    }
}
