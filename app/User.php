<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

    /*
     * return all the roles this user have
     * return @array
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_roles');
    }

    /*
     * return all the activities that this user will lead
     * return @array
     */
    public function ownsActivity()
    {
        return $this->belongsToMany('App\Activity','activity_owner', 'owner_id', 'activity_id');
    }

    /*
     * returns all the activities this user will go to
     * return @array
     */
    public function goesToActivity()
    {
        return $this->belongsToMany('App\Activity', 'activity_user', 'user_id', 'activity_id');
    }
}
