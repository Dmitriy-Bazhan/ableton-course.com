<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson_data extends Model
{

    public function lesson()
    {
        return $this->belongsTo('App\Lesson', 'lesson_id', 'id');
    }
}
