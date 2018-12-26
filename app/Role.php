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

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_roles');
    }
}
