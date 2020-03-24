<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'price'];

    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }
}
