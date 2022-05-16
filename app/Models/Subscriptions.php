<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    protected $fillable = ['name', 'status'];
    use HasFactory;

    public function YearSubscription()
    {
        return $this->hasOne(YearSubscriptions::class, 'subsraction_id', 'id');
    }
}
