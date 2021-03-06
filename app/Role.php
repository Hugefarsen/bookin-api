<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role'
    ];

    protected $hidden = [
        'pivot', 'created_at', 'updated_at', 'id'
    ];


    /*
     * returns all the users in this category
     * return @array
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_roles');
    }
}
