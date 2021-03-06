<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAccess;

Route::post('/api/message', 'ChatController@index')->middleware(['checkBan']);
Route::post('/chat/message', 'Site\ChatController@message')->middleware(['checkBan']);

Route::group([
    'prefix' => get_prefix(),
    'middleware' => ['checkBan'],
],
    function () {
        Route::get('/', 'Site\HomepageController@index');

        Route::get('/lesson/{lessonId?}', 'Lesson\LessonController@index')->name('lesson');
        Route::post('/user_start_video', 'Lesson\LessonController@userStartVideo');
        Route::post('/lesson_push_like_ajax', 'Lesson\LessonController@lessonPushLikeAjax');
        Route::post('/lesson_push_dislike_ajax', 'Lesson\LessonController@lessonPushDislikeAjax');
        Route::post('/lesson_add_to_favorites', 'Lesson\LessonController@lessonAddToFavorites');

        Route::get('/forum', 'Forum\ForumController@index')->name('forum');

        Route::get('/blog', 'Site\PageController@blog')->name('blog');

        Route::get('/contacts', 'Site\PageController@contacts')->name('contacts');

        Route::get('/chat', 'Site\ChatController@chat')->name('chat');

        Route::get('/about_us', 'Site\PageController@about_us')->name('about_us');

        Route::get('/user_profile', 'Site\ProfileController@index')->name('user_profile');
    });

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'checkAccess']
],
    function () {
        Route::get('/', 'Admin\AdminController@index')->name('admin');

        Route::resource('/lessons', 'Admin\LessonController');

        Route::resource('/category', 'Admin\CategoryController');

        Route::resource('/forum', 'Admin\ForumController');

        Route::resource('/blog', 'Admin\BlogController');

        Route::resource('/contacts', 'Admin\ContactsController');

        Route::resource('/about_us', 'Admin\About_usController');

        Route::resource('/users', 'Admin\UsersController');

        Route::resource('/chat', 'Admin\ChatController');
    });
Route::post('/lessons_enabled', 'Admin\LessonController@enabledChange');


//TODO(Авторизация и регистрация в соцсетях)
Route::get('/social-auth/{provider}', 'Auth\SocialController@redirectToProvider')->name('auth.social');
Route::get('/social-auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback')->name('auth.social.callback');

Route::get('auth/login', 'Auth\LoginController@indexAction');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\LoginController@getLogout');
Route::post('auth/logout', 'Auth\LoginController@getLogout');

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

