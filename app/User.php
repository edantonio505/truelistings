<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userProfile()
    {
        return $this->hasOne('App\userProfile');
    }

    public function checkIsAdmin()
    {
        return (bool) $this->isadmin;
    }

    public function checkIsBroker()
    {
        return (bool) $this->isbroker;
    }


    public function properties()
    {
        return $this->hasMany('App\Property');
    }


    // ---------------------------------------------------avatar pictures--------------------------------------
    public function getAvatarProfileUrl()
    {   
        $emailHash = md5($this->email);
        return "http://www.gravatar.com/avatar/".$emailHash."?d=mm&s=270";
    }


     public function getAvatarListUrl()
    {   
        $emailHash = md5($this->email);
        return "http://www.gravatar.com/avatar/".$emailHash."?d=mm&s=80";
    }

    // --------------------------------------------------------------------------------------------------------
}
