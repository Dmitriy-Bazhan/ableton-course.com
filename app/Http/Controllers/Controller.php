<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $data;

    public static function necessarily()
    {
        $data['path'] = take_path();
        $data['viewport'] = self::viewport();
        return $data;
    }

    public function AdminNecessarily()
    {
        $this->data['viewport'] = self::viewport();
        $this->data['adminList'] = [
            'lessons' => 'Уроки',
            'category' => 'Категории',
            'forum' => 'Форум',
            'blog' => 'Блог',
            'contacts' => 'Контакты',
            'about_us' => 'О нас',
            'users' => 'Пользователи',
            'chat' => 'Чат',
        ];
        $this->data['page_name'] = 'admin';
    }

    public static function viewport()
    {
        $agent = new Agent();

        if ($agent->isDesktop()) {
            return 'desktop';
        } elseif ($agent->isTablet()) {
            return 'tablet';
        } elseif ($agent->isMobile()) {
            return 'mobile';
        } else {
            return 'unknown-viewport';
        }
    }

    public function adminGuard()
    {
        $admin = new Admin();
        $admin->name_category = self::class();
        $admin->user_id = Auth::id();
        $admin->save();
        return;
    }
}
