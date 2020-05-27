<?php

namespace App\Http\Controllers\Lesson;

use App\Category;
use App\Lesson;
use App\Lesson_data;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index()
    {
        if (isset($_GET['id']) && !empty($_GET['id']) && Lesson::find($_GET['id'])) {
            $lessonId = $_GET['id'];
        } else {
            $lessonId = Lesson::orderBy('id')->select('id')->first()->id;
        }

        if (Auth::check()) {
            $lessonId = User::where('id', Auth::id())->select('last_lesson')->first()->last_lesson;
        }

        $this->data = self::necessarily();
        $this->data['page_name'] = 'lesson';

        $this->data['currentLesson'] = Lesson::where('id', $lessonId)->with('data')->first();

        $this->data['similarLessons'] = Lesson::where('category_id', $this->data['currentLesson']->category_id)
            ->where('id', '<>', $this->data['currentLesson']->id)
            ->where('enabled', true)->with('data')->inRandomOrder()->take(3)->get();


        $this->data['categories'] = Category::with('data')->with('lesson')->with('lesson_data')->get();
        return view('site.lesson.index', $this->data);
    }

    public function ajaxLesson(Request $request)
    {
        $lessonId = $request->post('id');

        $this->data['currentLesson'] = Lesson::where('id', $lessonId)->with('data')->where('enabled', true)->first();

        $this->data['similarLessons'] = Lesson::where('category_id', $this->data['currentLesson']->category_id)
            ->where('id', '<>', $this->data['currentLesson']->id)
            ->where('enabled', true)->with('data')->inRandomOrder()->take(3)->get();

        if (Auth::check()) {
            User::where('id', Auth::id())->update(['last_lesson' => $lessonId]);
        }
        return response()->json([
            'response_table' => view('site.lesson.lesson_content', $this->data)->render()
        ], 200);
    }
}
