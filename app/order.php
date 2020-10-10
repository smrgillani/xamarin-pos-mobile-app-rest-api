<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order extends Model
{
    //
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'user_id', 'profile_id', 'date', 'time', 'location', 'status',
    ];
    //////////////////////////////////////////////////////////////////////////
    ////////////////////////////+ RelationShip +//////////////////////////////
    //////////////////////////////////////////////////////////////////////////

    public function profile()
    {
        return $this->hasMany('App\profile', 'id', 'profile_id');
    }

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }

    //////////////////////////////////////////////////////////////////////////
    ////////////////////////////+ Functions +/////////////////////////////////
    //////////////////////////////////////////////////////////////////////////
}
