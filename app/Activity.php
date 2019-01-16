<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name', 'description', 'start', 'end', 'room_id', 'owner',
    ];

    protected $hidden = [
        'pivot', 'created_at', 'updated_at'
    ];


    public function owner()
    {
        return $this->belongsToMany('App\User','activity_owner', 'activity_id', 'owner_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'activity_user', 'activity_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\ActivityCategory', 'category_id');
    }

    public function room()
    {
        return $this->belongsTo('App\Room','room_id');
    }

}
