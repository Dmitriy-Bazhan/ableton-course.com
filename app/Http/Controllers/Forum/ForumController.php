<?php



namespace App\Http\Controllers\Forum;

use App\Forum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    public function index()
    {
        $data = self::necessarily();
        $data['page_name'] = 'forum';

        $data['forums'] = Forum::all();

        return view('site.forum.index', $data);
    }
}
