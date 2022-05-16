<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverPlacment extends Model
{
    use HasFactory;

    protected $guarded =[];


    public function Trips()
    {
        return $this->belongsTo(Trips::class , 'trip_id' , 'id');
    }

    public function Period()
    {
        return $this->belongsTo(Period::class);
    }

    public function Driver()
    {
        return $this->belongsTo(Driver::class);
    }


}
