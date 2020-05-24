<?php

namespace App\Http\Controllers\Lesson;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    public function index()
    {
        $this->data = self::necessarily();
        $this->data['page_name'] = 'lesson';
        return view('site.lesson.index', $this->data);
    }
}
