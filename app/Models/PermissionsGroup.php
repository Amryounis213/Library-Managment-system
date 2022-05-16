<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionsGroup extends Model
{
    protected $table = 'permissions_group';
    public function permissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('Spatie\Permission\Models\Permission','group_id','id');
    }
}
