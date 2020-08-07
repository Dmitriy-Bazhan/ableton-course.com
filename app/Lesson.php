<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use function GuzzleHttp\describe_type;

class Lesson extends Model
{
    public function data()
    {
        return $this->hasOne('App\Lesson_data', 'lesson_id', 'id')
            ->where('lang', app()->getLocale());
    }

    public function all_data()
    {
        return $this->hasMany('App\Lesson_data', 'lesson_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public static function storeOrUpdate($post, $lessonId = null)
    {
        if (is_null($lessonId)) {
            $lesson = new Lesson();
        } else {
            $lesson = Lesson::where('id', $lessonId)->first();
        }
        $lesson->id = !is_null($lessonId) ? $lessonId : Lesson::orderBy('id', 'desc')->first()->id + 1;
        $lesson->alias = !is_null($lessonId) ? $post['alias'] : Str::slug($post['name']['en'], '-');
        $lesson->category_id = $post['category_id'];
        $lesson->tags = json_encode(explode(',', $post['tags']));
        $lesson->image_big = $post['old_image_big'];
        $lesson->image_small = $post['old_image_small'];
        $lesson->save();
        $id = $lesson->id;

        $languages = ['en', 'ru', 'ua'];
        foreach ($languages as $lang) {
            if (is_null($lessonId)) {
                $lesson_data = new Lesson_data();
            } else {
                $lesson_data = Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->first();
            }
            $lesson_data->lesson_id = !is_null($lessonId) ? $lessonId : $id;
            $lesson_data->category_id = $post['category_id'];
            $lesson_data->lang = $lang;
            $lesson_data->name = $post['name'][$lang];
            $lesson_data->meta_title = $post['name'][$lang];
            $lesson_data->meta_description = $post['description'][$lang];
            $keywords = mb_substr($post['name'][$lang], 0, mb_strpos($post['name'][$lang], ' '));
            if (!$keywords) {
                $keywords = $post['name'][$lang];
            }
            $lesson_data->meta_keywords = $keywords;
            $lesson_data->short_description = $post['short_description'][$lang];
            $lesson_data->description = $post['description'][$lang];
            $lesson_data->video = $post['video'][$lang];
            $lesson_data->text = $post['text'][$lang];
            $lesson_data->save();
        }

        return;
    }

    public static function currentLesson($lessonId)
    {
        return self::where('id', $lessonId)->where('enabled', 1)->with('data')->first();
    }

}
