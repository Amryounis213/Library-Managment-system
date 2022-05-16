<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeWithChild extends Model
{
    use HasFactory;
    protected $fillable = ['price' ,'year' , 'income_id'];

    public function Income()
    {
        return $this->belongsTo(Income::class , 'income_id' , 'id');
    }

    public function Year()
    {
        return $this->belongsTo(Year::class , 'year' , 'id');
    }
}
