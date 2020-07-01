<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson_comment extends Model
{
    public static function comments($lessonId)
    {
        return self::where('lesson_datas_id', $lessonId)->orderBy('created_at', 'desc')->take(100)->get()->toArray();
    }
}
