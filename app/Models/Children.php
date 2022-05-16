<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Children extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
       'identity', 'name' , 'bth_date', 'add_date','father_id', 'father_rel', 'want_transport', 'kindergarten_id','gender' , 'added_by' , 'status' , 'address' , 'mother_name' , 'mother_mob'
   ];
   public function Father()
   {
        return $this->belongsTo(Father::class , 'father_id' , 'id');
   }
   public function creator()
   {
        return $this->belongsTo(User::class , 'added_by' , 'id');
   }

   public function ClassPlacement()
   {
        return $this->hasOne(ClassPlacment::class , 'children_id' , 'id');
   }

   public function attendance()
   {
       return $this->hasMany(ChildrenAttendances::class, 'children_id');
   }

   public function Subscription()
   {
        return $this->belongsToMany(Subscriptions::class , ChildrenSubscriptions::class , 'children_id' , 'subscription_id');
   }

   public function ChildrenSubscriptions()
   {
        return $this->hasMany(ChildrenSubscriptions::class , 'children_id' , 'id');
   }
   
   public function PayFee()
   {
        return $this->hasMany(PayFees::class , 'children_id' , 'id')->whereNull('deleted_at');
   }

   public function InComeRevenue()
   {
        return $this->hasMany(IncomesRevenue::class , 'children_id' , 'id')->whereNull('deleted_at');
   }

   public function Installment()
   {
        return $this->hasMany(Installment::class , 'children_id' , 'id');
   }
   
   
}
