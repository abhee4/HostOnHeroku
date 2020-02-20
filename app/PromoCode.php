<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fiallbel = [
        'discount',
        'code',
        'end_at',
        'status',
        'store_id'
    ];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
