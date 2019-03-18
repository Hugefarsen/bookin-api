<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityCategory extends Model
{
    protected $fillable = [
        'name', 'description', 'id',
    ];

    /*
     * returns all the activitys in this category
     * return @array
     */
    public function activities()
    {
        return $this->hasMany('App\Activity', 'category_id', 'id');

    }
}
