<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function mainpage()
    {
        $this->data['viewport'] = self::viewport();
        $this->data['page_name'] = 'admin';
        $this->data['adminList'] = [
            'lessons' => 'Уроки',
            'category' => 'Категории',
            'forum' => 'Форум',
            'blog' => 'Блог',
            'contacts' => 'Контакты',
            'about_us' => 'О нас',
            'users' => 'Пользователи',
        ];

        return view('admin.mainpage', $this->data);
    }

    public function lessons()
    {
        $this->data['page'] = 'lessons';
        return $this->mainpage();
    }

    public function forum()
    {
        $this->data['page'] = 'forum';
        return $this->mainpage();
    }

    public function blog()
    {
        $this->data['page'] = 'blog';
        return $this->mainpage();
    }

    public function contacts()
    {
        $this->data['page'] = 'contacts';
        return $this->mainpage();
    }

    public function about_us()
    {
        $this->data['page'] = 'about_us';
        return $this->mainpage();
    }

    public function users()
    {
        $this->data['page'] = 'users';
        return $this->mainpage();
    }

    public function category()
    {
        $this->data['page'] = 'category';
        return $this->mainpage();
    }


}
