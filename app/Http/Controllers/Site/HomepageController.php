<?php

namespace App\Http\Controllers\Site;

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

        $this->data = self::necessarily();
        $this->data['page_name'] = '/';
        return view('site.pages.homepage', $this->data);
    }
}
