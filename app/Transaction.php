<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'invoice_id',
        'status',
    ];


    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function invoice(){
        return $this-> belongsTo(Invoice::class);
    }
}
