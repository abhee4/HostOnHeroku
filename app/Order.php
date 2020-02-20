<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'cart_id',
        'total',
        'tax',
        'delivery',
        'status',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function vendors()
    {
        $vendors = [];
        $items = $this->cart->items;
        /**
         * @var $item CartItem
         */
        foreach ($items as $item) {
            array_push($vendors, $item->product()->owner);
        }
        return array_unique($vendors);
        //TODO: get the cart
        //TODO: get the cart items
        //TODO: foreach cart items we get the vendor
    }

    public function total(){
        //TODO:
    }
}
