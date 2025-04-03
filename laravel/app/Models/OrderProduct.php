<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
class OrderProduct extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'order_product';
    protected $fillable = ['order_id','product_id','price','quantity'];


    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
    public function order(): BelongsTo{
        return $this->belongsTo(Order::class);
    }
}
