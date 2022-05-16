<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Father extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name' , 'address' , 'mobile' ,'occupation'];

    public function Children()
    {
        return $this->hasMany(Children::class , 'father_id' , 'id');
    }
    
}
