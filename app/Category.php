<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($category) { // before delete() method call this
            $category->products()->delete();
            // do the rest of the cleanup...
        });
    }
}
