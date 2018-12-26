<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomProperty extends Model
{
    protected $fillable = [
        'activity_type', 'property', 'value', 'room_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
