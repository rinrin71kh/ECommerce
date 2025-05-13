<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Cart extends Model
{
    //
    // TP9
    use SoftDeletes;
    protected $table = 'cart';
    protected $dates = ['deleted_at'];
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
