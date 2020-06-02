<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {
        $this->AdminNecessarily();
        $this->data['page'] = 'category';
        $this->data['categories'] = Category::with('data')->paginate(10);
        return view('admin.category.category', $this->data);
    }

    public function create()
    {
        $this->AdminNecessarily();
        $this->data['page'] = 'category';
        $this->data['action'] = 'store';
        return view('admin.category.store_or_update', $this->data);
    }


    public function store(Request $request)
    {
        $post = $request->post();
        $rules = [
            'tags' => 'required',
            'name.en' => 'required',
            'name.ru' => 'required',
            'name.ua' => 'required',
            'description.en' => 'required',
            'description.ru' => 'required',
            'description.ua' => 'required',
        ];

        $check = Validator::make($post, $rules);

        if ($check->fails()) {
            return redirect()->back()
                ->withErrors($check)
                ->withInput();
        } else {
            Category::storeOrUpdate($post);
        }

        return redirect('admin/category');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $this->AdminNecessarily();
        $this->data['page'] = 'category';
        $this->data['action'] = 'update';
        $this->data['category'] = Category::where('id', $id)->with('all_data')->first();
        return view('admin.category.store_or_update', $this->data);
    }


    public function update(Request $request, $id)
    {
        $post = $request->post();
        $rules = [
            'alias' => 'required',
            'tags' => 'required',
            'name.en' => 'required',
            'name.ru' => 'required',
            'name.ua' => 'required',
            'description.en' => 'required',
            'description.ru' => 'required',
            'description.ua' => 'required',
        ];

        $check = Validator::make($post, $rules);

        if ($check->fails()) {
            return redirect()->back()
                ->withErrors($check)
                ->withInput();
        } else {
            Category::storeOrUpdate($post, $post['category_id']);
        }

        return redirect('admin/category');
    }


    public function destroy($id)
    {
        //
    }
}
