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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_roles');
    }

    public function ownsActivity()
    {
        return $this->belongsToMany('App\Activity','activity_owner', 'owner_id', 'activity_id');
    }

    public function goesToActivity()
    {
        return $this->belongsToMany('App\Activity', 'activity_user', 'user_id', 'activity_id');
    }
}
