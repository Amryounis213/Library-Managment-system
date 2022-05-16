<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensePay extends Model
{
    use HasFactory;
    
    protected $fillable = ['rec_name','expense_id' ,'year' ,'notices' ,'Receipt_number' , 'payment_amount' , 'payment_date'];

    public function Expense()
    {
        return $this->belongsTo(Expense::class , 'expense_id' , 'id');
    }
    public function Year()
    {
        return $this->belongsTo(Year::class , 'year' , 'id');
    }
}
