<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomesRevenue extends Model
{
    use HasFactory;
    protected $fillable = ['income_id','children_id' ,'year' ,'notices' ,'Receipt_number' , 'payment_amount' , 'payment_date'];
    public function Children()
    {
        return $this->belongsTo(Children::class , 'children_id' , 'id');
    }
    public function Year()
    {
        return $this->belongsTo(Year::class , 'year' , 'id');
    }


}
