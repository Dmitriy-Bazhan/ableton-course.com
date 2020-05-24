<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function about_us()
    {
        $this->data = self::necessarily();
        $this->data['page_name'] = 'about_us';
        return view('site.pages.about_us', $this->data);
    }

    public function contacts()
    {
        $this->data = self::necessarily();
        $this->data['page_name'] = 'contacts';
        return view('site.pages.contacts', $this->data);
    }

    public function blog()
    {
        $this->data = self::necessarily();
        $this->data['page_name'] = 'blog';
        return view('site.pages.blog', $this->data);
    }
}
