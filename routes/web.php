<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAccess;

Route::group([
    'prefix' => get_prefix(),
],
    function () {
        Route::get('/', 'Site\HomepageController@index');
        Route::get('/about_us', 'Site\PageController@about_us')->name('about_us');
        Route::get('/contacts', 'Site\PageController@contacts')->name('contacts');
        Route::get('/blog', 'Site\PageController@blog')->name('blog');
        Route::get('/forum', 'Forum\ForumController@index')->name('forum');
        Route::get('/lesson/{lessonId?}', 'Lesson\LessonController@index')->name('lesson');
        Route::get('/user_profile', 'Site\ProfileController@index')->name('user_profile');

    });

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'checkAccess']
],
    function () {
        Route::get('/', 'Admin\AdminController@lessons');
        Route::get('/lessons', 'Admin\AdminController@lessons')->name('admin/lessons');
        Route::get('/forum', 'Admin\AdminController@forum')->name('admin/forum');
        Route::get('/blog', 'Admin\AdminController@blog')->name('admin/blog');
        Route::get('/contacts', 'Admin\AdminController@contacts')->name('admin/contacts');
        Route::get('/about_us', 'Admin\AdminController@about_us')->name('admin/about_us');
        Route::get('/users', 'Admin\AdminController@users')->name('admin/users');
        Route::get('/category', 'Admin\AdminController@category')->name('admin/category');
    });


Route::get('/social-auth/{provider}', 'Auth\SocialController@redirectToProvider')->name('auth.social');
Route::get('/social-auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback')->name('auth.social.callback');

Route::get('auth/login', 'Auth\LoginController@indexAction');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\LoginController@getLogout');
Route::post('auth/logout', 'Auth\LoginController@getLogout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
