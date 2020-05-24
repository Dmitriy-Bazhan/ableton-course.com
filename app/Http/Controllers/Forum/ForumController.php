<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    public function index()
    {
        $this->data = self::necessarily();
        $this->data['page_name'] = 'forum';
        return view('site.forum.index', $this->data);
    }
}
