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

    public function productImages()
    {
        return $this->hasMany('App\ProductImage');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($product) { // before delete() method call this
            $product->productImages()->delete();
            // do the rest of the cleanup...
        });
    }
}
