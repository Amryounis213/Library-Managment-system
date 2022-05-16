<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenAttendances extends Model
{
    use HasFactory;

    protected $fillable=[
        'employee_id',
        'attendence_date',
        'attendence_status',
        'kindergarten_id' ,
        'division_id',
        'children_id' ,
        'period_id',
    ];


    public function Children()
    {
        return $this->belongsTo(Children::class , 'children_id' , 'id');
    }
}
