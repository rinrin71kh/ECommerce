<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = 'cart';
    protected $fillable = ['quantity','product_id','customer_id'];

    public function products():BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
