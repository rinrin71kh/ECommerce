<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customer';
    protected $fillable = ['name','email','address','phone'];
 
    public function carts(): HasMany 
    {
        return $this->hasMany(Cart::class);
    }

  
    public function wishlists(): HasMany 
    {
        return $this->hasMany(Wishlist::class);
    }

   
    public function orders(): HasMany 
    {
        return $this->hasMany(Order::class);
    }


    public function payments(): HasMany 
    {
        return $this->hasMany(Payment::class);
    }

    public function products(): HasMany 
    {
        return $this->belongsToMany(Product::class, 'cart', 'customer_id', 'product_id')->withPivot('quantity')->withTimestamps();
    }
}
