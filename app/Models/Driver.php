<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'name',
        'mobile',
        'bus_no',
        'kindergarten_id' ,
        'status',
        'deleted_at'
       
    ];

    public function Kindergarten()
    {
        return $this->belongsTo(Kindergarten::class , 'kindergarten_id' ,'id');
    }

    public function DriverPlacment()
    {
        return $this->hasOne(DriverPlacment::class , 'driver_id' , 'id');
    }
}
