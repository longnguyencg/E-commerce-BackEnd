<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'category_id'];

    public function categories()
    {
        return $this->belongsTo('App\Category');
    }
}
