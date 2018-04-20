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
        'type', 'region', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * User Regions
     *
     * @var array
     */
    public static $regions = [
        'eu' => 'EU',
        'us' => 'US',
        'test' => 'TEST',
    ];

    /**
     * The assets that belong to the user.
     */
    public function assets()
    {
        return $this->belongsToMany('App\Asset');
    }

    /**
     * Is the User an admin?
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return (boolean) ($this->type == 'admin');
    }
}
