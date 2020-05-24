<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index()
    {
        $this->data = self::necessarily();
        $this->data['page_name'] = '/';
        return view('site.pages.homepage', $this->data);
    }
}
