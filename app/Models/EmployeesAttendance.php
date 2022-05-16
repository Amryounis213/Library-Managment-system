<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesAttendance extends Model
{
    use HasFactory;

    protected $fillable=[
        'employee_id',
        'attendence_date',
        'attendence_status',
        'period_id',
    ];

    public function Employee()
    {
        return $this->belongsTo(Employee::class , 'employee_id' , 'id');
    }

}
