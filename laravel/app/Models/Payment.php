<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = 'payment';
    protected $fillable = ['payment_date','payment_method','amount','customer_id','order_id'];
    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class);
    }
    public function order(): BelongsTo{
        return $this->belongsTo(Order::class);
    }
}
