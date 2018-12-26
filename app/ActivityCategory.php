<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityCategory extends Model
{
    protected $fillable = [
        'name', 'description', 'id',
    ];

    public function activities()
    {
        return $this->belongsToMany('App\Activity', 'activities_activity_categories', 'activity_id', 'category_id');
    }
}
