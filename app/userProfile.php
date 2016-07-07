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


    public function getAvatarProfileUrl()
    {   
        $emailHash = md5($this->email);

        if($this->avatar == '' || $this->avatar == null)
        {
            return "http://www.gravatar.com/avatar/".$emailHash."?d=mm&s=270";
        }
        return $this->avatar;
    }


    public function getAvatarListUrl()
    {   
        $emailHash = md5($this->email);
        if($this->avatar == '' || $this->avatar == null)
        {
            return "http://www.gravatar.com/avatar/".$emailHash."?d=mm&s=80";
        }
        return $this->avatar;
    }
}
