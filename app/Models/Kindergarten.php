<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kindergarten extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'status', 'address' , 'phone'
    ];

    public function Children()
    {
        return $this->hasMany(ClassPlacment::class , 'kindergarten_id' , 'id');
    }
}
