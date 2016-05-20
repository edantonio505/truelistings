<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userProfile extends Model
{
   	protected $fillable = ['name', 'lastname', 'avatar', 'brokerLicense'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
