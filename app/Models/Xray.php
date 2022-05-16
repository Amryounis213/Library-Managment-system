<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Xray extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'price', 'status'
    ];
    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderXray::class);
    }
}
