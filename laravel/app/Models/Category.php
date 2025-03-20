<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'categories';
    protected $fillable = ['name'];
    public function products(): HasMany //1:M
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
