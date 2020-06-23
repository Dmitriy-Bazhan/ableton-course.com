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
        $data['currentLesson'] = Lesson::currentLesson($lessonId);
        $data['similarLessons'] = Lesson::similarLessons($data['currentLesson']->id, $data['currentLesson']->category_id);
        $data['categories'] = Category::categories();
        $data['comments'] = Lesson_comment::comments($lessonId);
        session()->put('currentLesson', $data['currentLesson']->id);

        return view('site.lesson.index', $data);
    }

    public function ajaxLesson(Request $request)
    {
        $lessonId = $request->post('id');

        if (Auth::check()) {
            User::where('id', Auth::id())->update(['last_lesson' => $lessonId]);
        }

        $data['userPushLike'] = $this->userPushLike($lessonId);
        $data['userPushDislike'] = $this->userPushDislike($lessonId);
        $data['currentLesson'] = Lesson::currentLesson($lessonId);
        $data['similarLessons'] = Lesson::similarLessons($data['currentLesson']->id, $data['currentLesson']->category_id);
        $data['comments'] = Lesson_comment::comments($lessonId);
        session()->put('currentLesson', $data['currentLesson']->id);

        return response()->json([
            'response' => view('site.lesson.lesson_content', $data)->render()
        ], 200);
    }

    public function lessonPushLikeAjax(Request $request)
    {
        $lessonId = $request->post('id');
        $push = $request->post('push');
        $lang = app()->getLocale();
        $userId = Auth::id();

        if ($push == 0) {
            $user_data = UserData::where('user_id', $userId)->select('push_like')->first();
            $temp = isset($user_data->push_like) ? json_decode($user_data->push_like, true) : null;
            $string = isset($temp[$lang]) ? $temp[$lang] : '';
            $temp[$lang] = !empty($string) ? $string . ',' . $lessonId : $lessonId;
            UserData::where('user_id', $userId)->update(['push_like' => json_encode($temp)]);
            $goodRang = Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->select('good_rang')->first()->good_rang;
            $goodRang++;
            Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->update(['good_rang' => $goodRang]);

        } elseif ($push == 1) {

            $user_data = UserData::where('user_id', $userId)->select('push_like')->first();
            $temp = isset($user_data->push_like) ? json_decode($user_data->push_like, true) : null;
            $string = isset($temp[$lang]) ? $temp[$lang] : '';
            $arr = explode(',', $string);

            foreach ($arr as $key => $item) {
                if ($arr[$key] == $lessonId) {
                    unset($arr[$key]);
                }
            }
            $string = implode(',', $arr);

            $temp[$lang] = $string;
            UserData::where('user_id', $userId)->update(['push_like' => json_encode($temp)]);
            $goodRang = Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->select('good_rang')->first()->good_rang;
            $goodRang--;
            Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->update(['good_rang' => $goodRang]);
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
        $lang = app()->getLocale();
        $userId = Auth::id();

        if ($push == 0) {
            $user_data = UserData::where('user_id', $userId)->select('push_dislike')->first();
            $temp = isset($user_data->push_dislike) ? json_decode($user_data->push_dislike, true) : null;
            $string = isset($temp[$lang]) ? $temp[$lang] : '';
            $temp[$lang] = !empty($string) ? $string . ',' . $lessonId : $lessonId;
            UserData::where('user_id', $userId)->update(['push_dislike' => json_encode($temp)]);
            $badRang = Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->select('bad_rang')->first()->bad_rang;
            $badRang++;
            Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->update(['bad_rang' => $badRang]);

        } elseif ($push == 1) {

            $user_data = UserData::where('user_id', $userId)->select('push_dislike')->first();
            $temp = isset($user_data->push_dislike) ? json_decode($user_data->push_dislike, true) : null;
            $string = isset($temp[$lang]) ? $temp[$lang] : '';
            $arr = explode(',', $string);

            foreach ($arr as $key => $item) {
                if ($arr[$key] == $lessonId) {
                    unset($arr[$key]);
                }
            }
            $string = implode(',', $arr);

            $temp[$lang] = $string;
            UserData::where('user_id', $userId)->update(['push_dislike' => json_encode($temp)]);
            $badRang = Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->select('bad_rang')->first()->bad_rang;
            $badRang--;
            Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->update(['bad_rang' => $badRang]);
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
        $userPushLike = null;
        if (Auth::check()) {
            $userData = UserData::where('user_id', Auth::id())->select('push_like')->first();
            if (!is_null($userData->push_like)) {
                $temp = json_decode($userData->push_like, true);
                $string = isset($temp[app()->getLocale()]) ? $temp[app()->getLocale()] : '';
                $arr = explode(',', $string);
            }
            if (!empty($string) && in_array($lessonId, $arr)) {
                $userPushLike = '1';
            } else {
                $userPushLike = '0';
            }
        }
        return $userPushLike;
    }

    private function userPushDislike($lessonId)
    {
        $userPushDislike = null;
        if (Auth::check()) {
            $userData = UserData::where('user_id', Auth::id())->select('push_dislike')->first();
            if (!is_null($userData->push_dislike)) {
                $temp = json_decode($userData->push_dislike, true);
                $string = isset($temp[app()->getLocale()]) ? $temp[app()->getLocale()] : '';
                $arr = explode(',', $string);
            }
            if (!empty($string) && in_array($lessonId, $arr)) {
                $userPushDislike = '1';
            } else {
                $userPushDislike = '0';
            }
        }
        return $userPushDislike;
    }
}
