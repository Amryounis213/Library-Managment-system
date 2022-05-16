<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayFees extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['children_id' ,'year' ,'notices' ,'Receipt_number' , 'payment_amount' , 'payment_date'];

    public function Children()
    {
        return $this->belongsTo(Children::class , 'children_id' , 'id');
    }
    public function Year()
    {
        return $this->belongsTo(Year::class , 'year' , 'id');
    }
}
