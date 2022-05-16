<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;
    protected $fillable=['name' ,'status'];

    public function ClassPlacment()
    {
        return $this->hasMany(ClassPlacment::class , 'period_id' , 'id');
    }

}
