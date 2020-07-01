<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserData;
use App\Lesson;
use App\Lesson_data;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $firstUser = new User();
        $firstUser->name = 'Dima';
        $firstUser->email = 'dimka@gmail.com';
        $firstUser->email_verified_at = now();
        $firstUser->password = '$2y$10$/xUbPd3hA2CWzA4P3KhgLurWRvLa8533QDiH/JRx7OztGhRcnEGxq'; // password
        $firstUser->remember_token = '5zEO3O8EmC7CgdyM94rYx8wsuaOoZn7KOXXNMFd9CEqoIkVqNdYfc6RaAoUV';
        $firstUser->role = 2;
        $firstUser->save();
        $firstId = User::all()->last()->id;
        User::where('id', $firstId)->update(['id' => 1]);

        $userdata = new UserData();
        $userdata->user_id = 1;
        $userdata->save();

        $names = ['first_category', 'second_category', 'third_category',
            'forth_category', 'fifth_category'];

        foreach ($names as $key => $name) {
            $category = new \App\Category();
            $category->alias = $name;
            $category->tags = json_encode($names);
            $category->save();
            $id = $category->id;

            $languages = ['en', 'ru', 'ua'];

            foreach ($languages as $lang) {
                $category_data = new \App\Category_data();
                $category_data->category_id = $id;
                $category_data->lang = $lang;
                $category_data->name = $name . 'name_in_' . $lang;
                $category_data->description = $lang . '_' . 'description_' . $name;
                $category_data->save();
            }
        }

        $aliases = ['first', 'second', 'third', 'forth', 'fifth', 'KKKKK', 'LLLLL', 'QQQQQ', 'WWWWWW',
            'AAAAA', 'BBBBB', 'CCCCC', 'DDDDD', 'EEEEE', 'FFFFF', 'GGGGG', 'HHHHH', 'JJJJJ'];

        $languages = ['en', 'ru', 'ua'];
        foreach ($languages as $lang) {
            $description[$lang] = '';
            for ($i = 0; $i < 15; $i++) {
                $description[$lang] = $description[$lang] . $lang . '_description ';
            }
        }

        foreach ($aliases as $key => $alias) {
            $lesson = new Lesson();
            $lesson->alias = $alias;
            $lesson->category_id = rand(1, 5);
            $lesson->tags = json_encode($languages);
            $lesson->image_big = $alias . '_big_image';
            $lesson->image_small = $alias . '_small_image';
            $lesson->save();
            $id = $lesson->id;
            $categoryId = $lesson->category_id;

            $languages = ['en', 'ru', 'ua'];

            foreach ($languages as $lang) {
                $lesson_data = new Lesson_data();
                $lesson_data->lesson_id = $id;
                $lesson_data->category_id = $categoryId;
                $lesson_data->lang = $lang;
                $lesson_data->name = $lang . '_Lesson_N_' . $id;
                $lesson_data->meta_title = $lang . '_' . 'meta_title_' . $alias;
                $lesson_data->meta_description = $lang . '_' . 'meta_description_' . $alias;
                $lesson_data->meta_keywords = $lang . '_' . 'meta_keywords_' . $alias;
                $lesson_data->short_description = $lang . '_' . 'short_description_' . $alias;
                $lesson_data->description = $description[$lang];
                $lesson_data->text = $lang . '_' . $alias . '_text';
                $lesson_data->save();
            }
        }

        $aliases = ['first', 'second', 'third'];
        foreach ($aliases as $alias) {
            $topic = new \App\Forum();
            $topic->alias = $alias;
            $topic->lang = 'en';
            $topic->name = strtoupper($alias);
            $topic->description = $alias . '_' . $alias . '_' . $alias;
            $topic->author = 1;
            $topic->tags = json_encode($languages);
            $topic->save();
        }
    }
}
