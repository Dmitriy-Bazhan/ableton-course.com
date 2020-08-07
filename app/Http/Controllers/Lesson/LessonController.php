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
use phpDocumentor\Reflection\Types\Object_;

class LessonController extends Controller
{
    public function index()
    {
        $data = self::necessarily();
        $data['page_name'] = 'lesson';

        if (isset($_GET['id']) && !empty($_GET['id']) && Lesson::where('id', $_GET['id'])->select('id')->first()) {
            $lessonId = $_GET['id'];
            if (Auth::check()) {
                User::where('id', Auth::id())->update(['last_lesson' => $lessonId]);
            }
        } elseif (Auth::check()) {
            $lessonId = User::where('id', Auth::id())->select('last_lesson')->firstOrFail()->last_lesson;
        } else {
            $lessonId = Lesson::orderBy('id')->select('id')->firstOrFail()->id;
        }

        $data['categories'] = Category::categories();
        foreach ($data['categories'] as $key => $category) {
            $arrayOfKeys = $category->lesson->KeyBy('id')->keys()->toArray();
            if (in_array($lessonId, $arrayOfKeys)) {
                $data['currentLesson'] = value($data['categories'][$key]->lesson->where('id', $lessonId)->first());
                $data['similarLessons'] = $data['categories'][$key]->lesson->where('id','<>' ,$lessonId)->take(3);
                break;
            }


        }
//        dd($data['currentLesson']->id);
        $data = array_merge($data, $this->usefulVars($lessonId, false));
        $data['comments'] = Lesson_comment::comments($lessonId);

        session()->put('currentLesson', $data['currentLesson']->id);

        return view('site.lesson.index', $data);
    }

    ##Ajax
    public function userStartVideo(Request $request)
    {
        $lessonId = $request->post('id');
        Lesson_data::where('lesson_id', $lessonId)->where('lang', app()->getLocale())->increment('views');
        return response()->json([], 200);
    }

    ##Ajax
    public function lessonPushLikeAjax(Request $request)
    {
        $lessonId = $request->post('id');
        $push = Auth::check() ? $request->post('push') : 2;
        $lang = app()->getLocale();
        $userId = Auth::id();
        $user_data = UserData::where('user_id', $userId)->select('push_like')->first();

        if ($push == 0) {
            $temp = isset($user_data->push_like) ? json_decode($user_data->push_like, true) : null;
            $string = isset($temp[$lang]) ? $temp[$lang] : '';
            $temp[$lang] = !empty($string) ? $string . ',' . $lessonId : $lessonId;
            UserData::where('user_id', $userId)->update(['push_like' => json_encode($temp)]);
            Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->increment('good_rang');
        } elseif ($push == 1) {

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
            Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->decrement('good_rang');
        }

        $data = $this->usefulVars($lessonId);
        return response()->json([
            'response' => view('site.lesson.under_video_buttons', $data)->render()
        ], 200);
    }

    ##Ajax
    public function lessonPushDislikeAjax(Request $request)
    {
        $lessonId = $request->post('id');
        $push = Auth::check() ? $request->post('push') : 2;
        $lang = app()->getLocale();
        $userId = Auth::id();
        $user_data = UserData::where('user_id', $userId)->select('push_dislike')->first();

        if ($push == 0) {
            $temp = isset($user_data->push_dislike) ? json_decode($user_data->push_dislike, true) : null;
            $string = isset($temp[$lang]) ? $temp[$lang] : '';
            $temp[$lang] = !empty($string) ? $string . ',' . $lessonId : $lessonId;
            UserData::where('user_id', $userId)->update(['push_dislike' => json_encode($temp)]);
            Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->increment('bad_rang');

        } elseif ($push == 1) {

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
            Lesson_data::where('lesson_id', $lessonId)->where('lang', $lang)->decrement('bad_rang');
        }

        $data = $this->usefulVars($lessonId);
        return response()->json([
            'response' => view('site.lesson.under_video_buttons', $data)->render()
        ], 200);
    }

    ##Ajax
    public function lessonAddToFavorites(Request $request)
    {
        $lessonId = $request->post('id');
        $push = Auth::check() ? $request->post('push') : 2;
        $lang = app()->getLocale();
        $userId = Auth::id();
        $user_data = UserData::where('user_id', $userId)->select('favorites')->first();

        if ($push == 0) {
            $temp = isset($user_data->favorites) ? json_decode($user_data->favorites, true) : null;
            $string = isset($temp[$lang]) ? $temp[$lang] : '';
            $temp[$lang] = !empty($string) ? $string . ',' . $lessonId : $lessonId;
            UserData::where('user_id', $userId)->update(['favorites' => json_encode($temp)]);

        } elseif ($push == 1) {

            $temp = isset($user_data->favorites) ? json_decode($user_data->favorites, true) : null;
            $string = isset($temp[$lang]) ? $temp[$lang] : '';
            $arr = explode(',', $string);

            foreach ($arr as $key => $item) {
                if ($arr[$key] == $lessonId) {
                    unset($arr[$key]);
                }
            }
            $string = implode(',', $arr);
            $temp[$lang] = $string;
            UserData::where('user_id', $userId)->update(['favorites' => json_encode($temp)]);
        }

        $data = $this->usefulVars($lessonId);

        return response()->json([
            'response' => view('site.lesson.under_video_buttons', $data)->render()
        ], 200);
    }

    private function usefulVars($lessonId, $whitCurrentLesson = true): array
    {
        if ($whitCurrentLesson) {
            $data['currentLesson'] = Lesson::currentLesson($lessonId);
        }
        $userData = null;
        if (Auth::check()) {
            $userData = UserData::where('user_id', Auth::id())->select('push_like', 'push_dislike', 'favorites')->first();
            $data['userPushLike'] = $this->userPushLike($lessonId, $userData);
            $data['userPushDislike'] = $this->userPushDislike($lessonId, $userData);
            $data['userAddFavorites'] = $this->userAddFavorites($lessonId, $userData);
        }
        return $data;
    }

    private function userPushLike($lessonId, $userData)
    {
        $userPushLike = null;
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
        return $userPushLike;
    }

    private function userPushDislike($lessonId, $userData)
    {
        $userPushDislike = null;
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
        return $userPushDislike;
    }

    private function userAddFavorites($lessonId, $userData)
    {
        $userAddFavorites = null;
        if (!is_null($userData->favorites)) {
            $temp = json_decode($userData->favorites, true);
            $string = isset($temp[app()->getLocale()]) ? $temp[app()->getLocale()] : '';
            $arr = explode(',', $string);
        }
        if (!empty($string) && in_array($lessonId, $arr)) {
            $userAddFavorites = '1';
        } else {
            $userAddFavorites = '0';
        }
        return $userAddFavorites;
    }

}
