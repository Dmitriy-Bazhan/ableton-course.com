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

        return view('site.chat.index', $data);
    }


    public function message(Request $request)
    {
        $message = clearVar($request->input('message', ''));

        if (strlen($message)) {
            $comment = new Chat();
            $comment->user_id = Auth::id();

            $user = Auth::user()->name;
            $id = Auth::user()->id;
            $message = '<span class="username_message"> ' . $user . ': </span> ' . $message;

            $comment->comment = $message;
            $comment->save();

            event(new ChatMessageSend($message, $id));
        }
    }
}
