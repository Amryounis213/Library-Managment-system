<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassPlacment extends Model
{
    use HasFactory;
    protected $fillable = [
        'period_id' ,'employee_id' , 'level_id','division_id' , 'children_id' , 'year' , 'kindergarten_id'
   ];

   public function Kindergarten()
   {
        return $this->belongsTo(Kindergarten::class , 'kindergarten_id' , 'id');
   }
   public function Children()
   {
       return $this->belongsTo(Children::class , 'children_id' , 'id');
   }

   public function Employee()
   {
       return $this->belongsTo(Employee::class , 'employee_id' , 'id');
   }
   
   public function Period()
   {
       return $this->belongsTo(Period::class , 'period_id' , 'id');
   }
  
   public function Level()
   {
       return $this->belongsTo(Level::class , 'level_id' , 'id');
   }

   public function Division()
   {
       return $this->belongsTo(Division::class , 'division_id' , 'id');
   }

   public function Year()
   {
    return $this->belongsTo(Year::class , 'year' , 'id');

   }
}
