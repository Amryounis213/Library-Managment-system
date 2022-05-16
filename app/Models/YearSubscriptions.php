<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearSubscriptions extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'year' , 'subsraction_id' , 'static_fee'];

    public function Subscription()
    {
        return $this->belongsTo(Subscriptions::class , 'subsraction_id' , 'id');
    }


}
