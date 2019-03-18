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

    /*
     * Owner of activity
     * return @array
     */
    public function owner()
    {
        return $this->belongsToMany('App\User','activity_owner', 'activity_id', 'owner_id');
    }

    /*
     * Users that goes to activity
     * return @array
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'activity_user', 'activity_id', 'user_id');
    }

    /*
     * Category that describes activity
     * return @object
     */
    public function category()
    {
        return $this->belongsTo('App\ActivityCategory', 'category_id');
    }

    /*
     * Room that activity will use
     * return @object
     */
    public function room()
    {
        return $this->belongsTo('App\Room','room_id');
    }

}
