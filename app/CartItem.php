<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'product_id',
        'qty',
        'price',
        'line_total',
        'cart_id',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }


    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
