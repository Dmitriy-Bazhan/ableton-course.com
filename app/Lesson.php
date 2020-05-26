<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function data()
    {
        return $this->hasOne('App\Lesson_data','lesson_id', 'id')
            ->where('lang', app()->getLocale());
    }

    public function all_data()
    {
        return $this->hasMany('App\Lesson_data','lesson_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }
}
