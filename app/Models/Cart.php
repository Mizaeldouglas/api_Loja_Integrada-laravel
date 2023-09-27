<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['session_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product', 'session_id', 'product_id')->withPivot('quantity');
    }
}