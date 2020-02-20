<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(Invoice::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class);
    }
}
