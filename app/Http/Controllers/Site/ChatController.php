<?php

namespace App\Http\Controllers\Site;

use App\Chat;
use App\Events\ChatMessageSend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $data = self::necessarily();
        $data['page_name'] = 'chat';
        $data['comments'] = Chat::latest()->take(100)->get();

<<<<<<< HEAD

        $connect = new \PDO('mysql:dbname=onlineschool;host=127.0.0.1','root','');
        $result = $connect->prepare('SELECT * FROM lessons JOIN lesson_datas ON
                                     lessons.id = lesson_datas.lesson_id WHERE lesson_datas.lang = \'en\'');
        $result->execute();


        dd($result->fetchAll(\PDO::FETCH_ASSOC));
=======
//        dd($request);
>>>>>>> e4e0ec76876d06a12883ba5a15e8d6be70be2903
        return view('site.chat.index', $data);

    }


    public function message(Request $request)
    {
        $message = clearVar($request->input('message', ''));

        if (strlen($message)) {
            $comment = new Chat();
            $comment->user_id = Auth::id();

            $user = \App\User::find($comment->user_id)->name;
            $message = '<span class="username_message"> ' . $user . ': </span> ' . $message;

            $comment->comment = $message;
            $comment->save();

            event(new ChatMessageSend($message));
        }
    }
}
