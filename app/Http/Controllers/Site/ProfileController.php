<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $this->data = self::necessarily();
        $this->data['page_name'] = 'user_profile';
        return view('site.pages.user_profile', $this->data);
    }
}
