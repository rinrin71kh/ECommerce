<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Order extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
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

    protected function orderDate(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Carbon::createFromFormat('d/m/Y H:i:s', $value)->format('Y-m-d H:i:s'),
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y H:i:s')
        );
    }

}
