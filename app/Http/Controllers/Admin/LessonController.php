<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Lesson;
use App\Lesson_data;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    public function index()
    {
        $this->AdminNecessarily();
        $this->data['page'] = 'lessons';
        $this->data['lessons'] = Lesson::with('all_data')->paginate(10);
        $this->data['categories'] = Category::with('data')->get();
        return view('admin.lessons.lessons', $this->data);
    }

    public function create()
    {
        $this->AdminNecessarily();
        $this->data['page'] = 'lessons';
        $this->data['action'] = 'store';
        $this->data['categories'] = Category::with('data')->get();
        return view('admin.lessons.store_or_update', $this->data);
    }

    public function store(Request $request)
    {
        $post = $request->post();
        $rules = [
            'category_id' => 'required',
            'tags' => 'required',
            'name.en' => 'required',
            'name.ru' => 'required',
            'name.ua' => 'required',
//            'meta_title.en' => 'required',
//            'meta_title.ru' => 'required',
//            'meta_title.ua' => 'required',
//            'meta_description.en' => 'required',
//            'meta_description.ru' => 'required',
//            'meta_description.ua' => 'required',
//            'meta_keywords.en' => 'required',
//            'meta_keywords.ru' => 'required',
//            'meta_keywords.ua' => 'required',
            'short_description.en' => 'required',
            'short_description.ru' => 'required',
            'short_description.ua' => 'required',
            'description.en' => 'required',
            'description.ru' => 'required',
            'description.ua' => 'required',
            'text.en' => 'required',
            'text.ru' => 'required',
            'text' => 'required',
        ];

        $check = Validator::make($post, $rules);

        if ($check->fails()) {
            return redirect()->back()
                ->withErrors($check)
                ->withInput();
        } else {
            Lesson::storeOrUpdate($post);
        }

        $lesson_id = Lesson::orderBy('id', 'desc')->first()->id;

        if ($request->hasFile('imageBig')) {
            $file = $request->file('imageBig');
            $file->move('storage/image_big/', $lesson_id . '_' . $file->getClientOriginalName());
            Lesson::where('id', $lesson_id)->update(['image_big' => $file->getClientOriginalName()]);
        }

        if ($request->hasFile('imageSmall')) {
            $file = $request->file('imageSmall');
            $file->move('storage/image_small/', $lesson_id . '_' . $file->getClientOriginalName());
            Lesson::where('id', $lesson_id)->update(['image_small' => $file->getClientOriginalName()]);
        }

        $languages = ['en', 'ru', 'ua'];
        foreach ($languages as $lang) {
            if ($request->hasFile('video.' . $lang)) {
                $file = $request->file('video.' . $lang);
                $file->move('storage/video/' . $lang . '/', $lesson_id . '_' . $file->getClientOriginalName());
                Lesson_data::where('lesson_id', $lesson_id)->where('lang', $lang)
                    ->update(['video' => $lesson_id . '_' . $file->getClientOriginalName()]);
            }
        }

        return redirect('admin/lessons');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->AdminNecessarily();
        $this->data['page'] = 'lessons';
        $this->data['action'] = 'update';
        $this->data['lesson'] = Lesson::where('id', $id)->with('all_data')->first();
        $this->data['categories'] = Category::with('data')->get();

        return view('admin.lessons.store_or_update', $this->data);
    }

    public function update(Request $request, $id)
    {
        $post = $request->post();
        $rules = [
            'alias' => 'required',
            'category_id' => 'required',
            'tags' => 'required',
            'name.en' => 'required',
            'name.ru' => 'required',
            'name.ua' => 'required',
//            'meta_title.en' => 'required',
//            'meta_title.ru' => 'required',
//            'meta_title.ua' => 'required',
//            'meta_description.en' => 'required',
//            'meta_description.ru' => 'required',
//            'meta_description.ua' => 'required',
//            'meta_keywords.en' => 'required',
//            'meta_keywords.ru' => 'required',
//            'meta_keywords.ua' => 'required',
            'short_description.en' => 'required',
            'short_description.ru' => 'required',
            'short_description.ua' => 'required',
            'description.en' => 'required',
            'description.ru' => 'required',
            'description.ua' => 'required',
            'text.en' => 'required',
            'text.ru' => 'required',
            'text' => 'required',
        ];

        $check = Validator::make($post, $rules);

        if ($check->fails()) {
            return redirect()->back()
                ->withErrors($check)
                ->withInput();
        } else {
            Lesson::storeOrUpdate($post, $post['lesson_id']);
        }

        if ($request->hasFile('imageBig')) {
            $f = Storage::disk();
            $f->delete('public/image_big/' . $post['old_image_big']);
            $file = $request->file('imageBig');
            $file->move('storage/image_big/', $file->getClientOriginalName());
            Lesson::where('id', $post['lesson_id'])->update(['image_big' => $file->getClientOriginalName()]);
        }

        if ($request->hasFile('imageSmall')) {
            $f = Storage::disk();
            $f->delete('public/image_small/' . $post['old_image_small']);
            $file = $request->file('imageSmall');
            $file->move('storage/image_small/', $file->getClientOriginalName());
            Lesson::where('id', $post['lesson_id'])->update(['image_small' => $file->getClientOriginalName()]);
        }

        $languages = ['en', 'ru', 'ua'];
        foreach ($languages as $lang) {
            if ($request->hasFile('video.' . $lang)) {
                $f = Storage::disk();
                $f->delete('public/video/'. $lang . '/' . $post['old_video'][$lang]);
                $file = $request->file('video.' . $lang);
                $file->move('storage/video/' .  $lang . '/', $post['lesson_id'] . '_' . $file->getClientOriginalName());
                Lesson_data::where('lesson_id', $post['lesson_id'])->where('lang', $lang)
                             ->update(['video' => $post['lesson_id'] . '_' . $file->getClientOriginalName()]);
            }
        }

        return redirect('admin/lessons');
    }

    public function destroy($id)
    {
        //
    }

}
