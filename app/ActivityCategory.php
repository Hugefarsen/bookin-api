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
        return $this->hasMany('App\Activity', 'category_id', 'id');

    }
}
