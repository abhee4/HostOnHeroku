<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $fillable = [
        'title', 'description', 'price', 'discount', 'prepare_time', 'chef', 'likes', 'user_id', 'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function media()
    {
        return $this->hasMany(Media::class, 'belongs_to', 'id');
    }
    public function deals()
    {
        return $this->belongsToMany(Product::class);
    }
    public function favouriteUsers()
    {
        return $this->belongsToMany(User::class);
    }
}
