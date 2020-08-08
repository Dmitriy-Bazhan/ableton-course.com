<?php

namespace App\Http\Controllers\Site;

use App\Lesson;
use App\Lesson_data;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index()
    {
        if (empty(session('check_lang')) && Auth::id()) {
            $lang = User::where('id', Auth::id())->select('lang')->first();
            app()->setLocale($lang->lang);
            session()->put('check_lang', $lang->lang);
            $path = $lang->lang == 'en' ? '' : $lang->lang;
            return redirect('/' . $path);
        }

        if (Auth::check()) {
            session()->forget('message_for_banned_users');
        }

        $data = self::necessarily();
        $data['lastItems'] = Lesson::where('enabled', 1)->latest()->take(3)->with('data')->get();
        $data['popularLessons'] = Lesson_data::orderByDesc('views')->where('lang', app()->getLocale())->take(3)->with('lesson')->get();
        $data['page_name'] = '/';
        return view('site.pages.homepage', $data);
    }
}
