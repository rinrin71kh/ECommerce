<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'order';
    protected $fillable = ['total_price','order_date','customer_id'];

  
    public function payments(): HasMany 
    {
        return $this->hasMany(Payment::class);
    }
    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function order_product():HasMany
    {
        return $this->hasMany(OrderProduct :: class);
    }
}
