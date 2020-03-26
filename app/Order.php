<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['shippedDate','status','comment', 'total_price', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
