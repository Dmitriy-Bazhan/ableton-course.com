<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        return $this->hasMany('App\Lesson', 'category_id', 'id')->where('enabled', 1);
    }


    public static function storeOrUpdate($post, $categoryId = null)
    {
        if (is_null($categoryId)) {
            $category = new Category();
        } else {
            $category = Category::where('id', $categoryId)->first();
        }
        $category->id = !is_null($categoryId) ? $categoryId : Category::orderBy('id', 'desc')->first()->id + 1;
        $category->alias = !is_null($categoryId) ? $post['alias'] : Str::slug($post['name']['en'], '-');
        $category->tags = json_encode(explode(',' ,$post['tags']));
        $category->save();
        $id = $category->id;

        $languages = ['en', 'ru', 'ua'];
        foreach ($languages as $lang) {
            if (is_null($categoryId)) {
                $category_data = new Category_data();
            } else {
                $category_data = Category_data::where('category_id', $categoryId)->where('lang', $lang)->first();
            }
            $category_data->category_id = !is_null($categoryId) ? $categoryId : $id;
            $category_data->lang = $lang;
            $category_data->name = $post['name'][$lang];
            $category_data->description = $post['description'][$lang];
            $category_data->save();
        }

        return;
    }

    public static function categories()
    {
        return self::with('data')->with('lesson.data')->get();
    }
}
