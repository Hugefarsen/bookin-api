<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'description', 'properties'
    ];

    protected $hidden = [
        'pivot', 'created_at', 'updated_at'
    ];

}
