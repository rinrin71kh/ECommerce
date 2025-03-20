<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Whistlist extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'whistlist';
    protected $fillable = ['product_id','customer_id'];

    public function products():BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
