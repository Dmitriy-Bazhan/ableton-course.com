<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function data()
    {
        return $this->hasOne('App\Category_data', 'category_id', 'id')
            ->where('lang', app()->getLocale());
    }

    public function all_data()
    {
        return $this->hasMany('App\Category_data', 'category_id', 'id');
    }

    public function lesson()
    {
        return $this->hasMany('App\Lesson', 'category_id', 'id');
    }

    public function lesson_data()
    {
        return $this->hasMany('App\Lesson_data', 'category_id', 'id')
            ->where('lang', app()->getLocale());
    }
}
