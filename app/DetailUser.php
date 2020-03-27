<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    protected $fillable=['user_id', 'name', 'email', 'phone', 'address','addressOther', 'avatar'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
