<?php

namespace App\Http\Controllers\Lesson;

use App\Category;
use App\Lesson;
use App\Lesson_comment;
use App\Lesson_data;
use App\User;
use App\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index()
    {
        $data = self::necessarily();
        $data['page_name'] = 'lesson';

        if (isset($_GET['id']) && !empty($_GET['id']) && Lesson::find($_GET['id'])) {
            $lessonId = $_GET['id'];
            if (Auth::check()) {
                User::where('id', Auth::id())->update(['last_lesson' => $lessonId]);
            }
        } elseif (Auth::check()) {
            $lessonId = User::where('id', Auth::id())->select('last_lesson')->first()->last_lesson;
        } else {
            $lessonId = Lesson::orderBy('id')->select('id')->first()->id;
        }


        $data['userPushLike'] = $this->userPushLike($lessonId);
        $data['userPushDislike'] = $this->userPushDislike($lessonId);

        $data['currentLesson'] = Lesson::where('id', $lessonId)->with('data')->first();
        $data['similarLessons'] = Lesson::where('category_id', $data['currentLesson']->category_id)
            ->where('id', '<>', $data['currentLesson']->id)
            ->where('enabled', true)->with('data')->inRandomOrder()->take(3)->get();
        $data['categories'] = Category::with('data')->with('lesson')->with('lesson_data')->get();
        $data['comments'] = Lesson_comment::where('lesson_datas_id', $lessonId)->get()->toArray();

        session()->put('currentLesson', $data['currentLesson']->id);
        return view('site.lesson.index', $data);
    }

    public function ajaxLesson(Request $request)
    {
        $lessonId = $request->post('id');

        if (Auth::check()) {
            User::where('id', Auth::id())->update(['last_lesson' => $lessonId]);
        }

        $data['currentLesson'] = Lesson::where('id', $lessonId)->with('data')->where('enabled', true)->first();

        $data['similarLessons'] = Lesson::where('category_id', $data['currentLesson']->category_id)
            ->where('id', '<>', $data['currentLesson']->id)
            ->where('enabled', true)->with('data')->inRandomOrder()->take(3)->get();

        $data['userPushLike'] = $this->userPushLike($lessonId);
        $data['userPushDislike'] = $this->userPushDislike($lessonId);
        $data['comments'] = Lesson_comment::where('lesson_datas_id', $lessonId)->get()->toArray();

        session()->put('currentLesson', $data['currentLesson']->id);
        return response()->json([
            'response' => view('site.lesson.lesson_content', $data)->render()
        ], 200);
    }

    public function lessonPushLikeAjax(Request $request)
    {
        $lessonId = $request->post('id');
        $push = $request->post('push');

        if ($push == 0) {
            $data['user_data'] = UserData::where('user_id', Auth::id())->first();
            $temp = isset($data['user_data']->push_like) ? json_decode($data['user_data']->push_like, true) : null;
            $string = isset($temp[app()->getLocale()]) ? $temp[app()->getLocale()] : '';
            $temp[app()->getLocale()] = !empty($string) ? $string . ',' . $lessonId : $lessonId;
            UserData::where('user_id', Auth::id())->update(['push_like' => json_encode($temp)]);
            $goodRang = Lesson_data::where('lesson_id', $lessonId)->where('lang', app()->getLocale())->select('good_rang')->first()->good_rang;
            $goodRang++;
            Lesson_data::where('lesson_id', $lessonId)->where('lang', app()->getLocale())->update(['good_rang' => $goodRang]);

        } elseif ($push == 1) {

            $data['user_data'] = UserData::where('user_id', Auth::id())->first();
            $temp = isset($data['user_data']->push_like) ? json_decode($data['user_data']->push_like, true) : null;
            $string = isset($temp[app()->getLocale()]) ? $temp[app()->getLocale()] : '';
            $arr = explode(',', $string);

            foreach ($arr as $key => $item) {
                if ($arr[$key] == $lessonId) {
                    unset($arr[$key]);
                }
            }
            $string = implode(',', $arr);

            $temp[app()->getLocale()] = $string;
            UserData::where('user_id', Auth::id())->update(['push_like' => json_encode($temp)]);
            $goodRang = Lesson_data::where('lesson_id', $lessonId)->where('lang', app()->getLocale())->select('good_rang')->first()->good_rang;
            $goodRang--;
            Lesson_data::where('lesson_id', $lessonId)->where('lang', app()->getLocale())->update(['good_rang' => $goodRang]);
        }

        $data['currentLesson'] = Lesson::where('id', $lessonId)->with('data')->first();
        $data['userPushLike'] = $this->userPushLike($lessonId);
        $data['userPushDislike'] = $this->userPushDislike($lessonId);

        return response()->json([
            'response' => view('site.lesson.under_video_buttons', $data)->render()
        ], 200);
    }

    public function lessonPushDislikeAjax(Request $request)
    {
        $lessonId = $request->post('id');
        $push = $request->post('push');

        if ($push == 0) {
            $data['user_data'] = UserData::where('user_id', Auth::id())->first();
            $temp = isset($data['user_data']->push_dislike) ? json_decode($data['user_data']->push_dislike, true) : null;
            $string = isset($temp[app()->getLocale()]) ? $temp[app()->getLocale()] : '';
            $temp[app()->getLocale()] = !empty($string) ? $string . ',' . $lessonId : $lessonId;
            UserData::where('user_id', Auth::id())->update(['push_dislike' => json_encode($temp)]);
            $badRang = Lesson_data::where('lesson_id', $lessonId)->where('lang', app()->getLocale())->select('bad_rang')->first()->bad_rang;
            $badRang++;
            Lesson_data::where('lesson_id', $lessonId)->where('lang', app()->getLocale())->update(['bad_rang' => $badRang]);

        } elseif ($push == 1) {

            $data['user_data'] = UserData::where('user_id', Auth::id())->first();
            $temp = isset($data['user_data']->push_dislike) ? json_decode($data['user_data']->push_dislike, true) : null;
            $string = isset($temp[app()->getLocale()]) ? $temp[app()->getLocale()] : '';
            $arr = explode(',', $string);

            foreach ($arr as $key => $item) {
                if ($arr[$key] == $lessonId) {
                    unset($arr[$key]);
                }
            }
            $string = implode(',', $arr);

            $temp[app()->getLocale()] = $string;
            UserData::where('user_id', Auth::id())->update(['push_dislike' => json_encode($temp)]);
            $badRang = Lesson_data::where('lesson_id', $lessonId)->where('lang', app()->getLocale())->select('bad_rang')->first()->bad_rang;
            $badRang--;
            Lesson_data::where('lesson_id', $lessonId)->where('lang', app()->getLocale())->update(['bad_rang' => $badRang]);
        }

        $data['currentLesson'] = Lesson::where('id', $lessonId)->with('data')->first();
        $data['userPushLike'] = $this->userPushLike($lessonId);
        $data['userPushDislike'] = $this->userPushDislike($lessonId);

        return response()->json([
            'response' => view('site.lesson.under_video_buttons', $data)->render()
        ], 200);
    }

    private function userPushLike($lessonId)
    {
        $data['userPushLike'] = null;

        if (Auth::check()) {
            $data['user'] = User::where('id', Auth::id())->with('data')->first();
            if (!is_null($data['user']->data->push_like)) {
                $temp = json_decode($data['user']->data->push_like, true);
                $string = isset($temp[app()->getLocale()]) ? $temp[app()->getLocale()] : '';
                $arr = explode(',', $string);
            }

            if (!empty($string) && in_array($lessonId, $arr)) {
                $data['userPushLike'] = '1';
            } else {
                $data['userPushLike'] = '0';
            }
        }

        return $data['userPushLike'];
    }

    private function userPushDislike($lessonId)
    {
        $data['userPushDislike'] = null;

        if (Auth::check()) {
            $data['user'] = User::where('id', Auth::id())->with('data')->first();
            if (!is_null($data['user']->data->push_dislike)) {
                $temp = json_decode($data['user']->data->push_dislike, true);
                $string = isset($temp[app()->getLocale()]) ? $temp[app()->getLocale()] : '';
                $arr = explode(',', $string);
            }

            if (!empty($string) && in_array($lessonId, $arr)) {
                $data['userPushDislike'] = '1';
            } else {
                $data['userPushDislike'] = '0';
            }
        }

        return $data['userPushDislike'];
    }
}
