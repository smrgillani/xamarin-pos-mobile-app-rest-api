<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'access_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'remember_token',
    ];

    //////////////////////////////////////////////////////////////////////////
    ////////////////////////////+ RelationShip +//////////////////////////////
    //////////////////////////////////////////////////////////////////////////

    public function UserTypes()
    {
        return $this->belongsTo('App\UserType', 'user_type_id');
    }

    //////////////////////////////////////////////////////////////////////////
    ////////////////////////////+ Functions +/////////////////////////////////
    //////////////////////////////////////////////////////////////////////////

    /**
     * Get User Information.
     *
     * @param  Boolean $accessToken
     * @return Array $data
     */
    public function getUserInformation($accessToken = false)
    {

        if ($accessToken) {
            $data = $this->createToken('Token Name')->accessToken;
        }

        return $data;
    }

}
