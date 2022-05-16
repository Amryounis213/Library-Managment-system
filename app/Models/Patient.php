<?php

namespace App\Models;

use App\Core\Traits\SpatieLogsActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SpatieLogsActivity;
    use SoftDeletes;

    protected $fillable = [
        'identity', 'name', 'mobile', 'dob', 'gender', 'countries_id', 'states_id', 'cities_id', 'address',
        'nationality_id', 'status', 'created_by'
    ];

    public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }
    //////////////////////////////////////////////
    function searchByIdentity($identity)
    {
        return $this->where('identity', 'LIKE', '%' . $identity . '%')
            ->orderBy('id', 'desc')
            ->get();
    }

    //////////////////////////////////////////////
    public function age()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }


}
