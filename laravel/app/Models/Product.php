<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
 
       //
       use SoftDeletes;
       protected $dates = ['deleted_at'];
       protected $table = 'products';
       protected $fillable = ['name' , 'category_id', 'pricing', 'description', 'images'];

    public function category(): BelongsTo //M:1
        {
            return $this->belongsTo(Category::class, 'category_id','id')
            ->select('id', 'name');
        }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart:: class);
    }
    public function whistlists(): HasMany
    {
        return $this->hasMany(Whistlist:: class);
    }
    public function order_product(): HasMany
    {
        return $this->hasMany(Order_Product:: class);
    }
}
