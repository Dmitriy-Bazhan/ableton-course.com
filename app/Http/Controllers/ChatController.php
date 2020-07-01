<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Lesson_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {

        $message = $request->input('message', '');

        if (strlen($message)) {
            $comment = new Lesson_comment();
            $comment->author = Auth::id();

            $user = \App\User::find($comment->author)->name;
            $message = '<span class="username_message"> ' . $user . ': </span> ' . $message;

            $comment->good_rang = 0;
            $comment->bad_rang = 0;
            $comment->body = $message;
            $comment->lesson_datas_id = session('currentLesson');
            $comment->save();

            event(new MessageSend($message));
        }
    }
}
