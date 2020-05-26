<?php

namespace App\Http\Controllers\Lesson;

use App\Category;
use App\Lesson;
use App\Lesson_data;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    public function index($lessonId = null)
    {

        $this->data = self::necessarily();
        $this->data['page_name'] = 'lesson';

        if (is_null($lessonId)) {
            $lessonId = Lesson::orderBy('id')->select('id')->first()->id;
        }


        $this->data['currentLesson'] = Lesson::where('id', $lessonId)->with('data')->where('enabled', false)->first();

        $this->data['similarLessons'] = Lesson::where('category_id', $this->data['currentLesson']->category_id)
                                       ->where('id', '<>', $this->data['currentLesson']->id)
                                       ->where('enabled', false)->with('data')->inRandomOrder()->take(3)->get();

        $this->data['categories'] = Category::with('data')->with('lesson')->with('lesson_data')->get();

        return view('site.lesson.index', $this->data);
    }
}
