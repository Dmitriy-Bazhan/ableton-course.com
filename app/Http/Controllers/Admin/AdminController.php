<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function mainpage()
    {
        $this->data = self::necessarily();
        $this->data['page_name'] = 'admin';
        return view('admin.mainpage', $this->data);
    }
}
