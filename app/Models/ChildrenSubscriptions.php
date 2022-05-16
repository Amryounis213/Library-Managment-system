<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildrenSubscriptions extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['children_id' , 'subscription_id' , 'total' , 'required_amount' , 'discount' , 'discount_id' , 'year'];

    
    public function Subscription()
    {
        return $this->belongsTo(Subscriptions::class , 'subscription_id' ,'id');
    }

    public function Children()
    {
        return $this->belongsTo(Children::class , 'children_id' ,'id');
    }

    public function Year()
    {
        return $this->belongsTo(Year::class , 'year' ,'id');
    }
}
