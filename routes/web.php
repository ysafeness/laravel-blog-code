<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\ContactController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/blog');
});
Route::get('/blog',[BlogController::class,'index'])->name('blog.home');
Route::get('/blog/{slug}',[BlogController::class,'showPost'])->name('blog.detail');
/**
 * 后台路由
 */
Route::get("/admin",function(){
    return redirect("/admin/post");
});
Route::middleware('auth')->group(function(){
    Route::resource('admin/post',PostController::class,['except'=>'show']);
    // Route::resource('admin/tag',TagController::class);
    Route::resource('admin/tag',TagController::class,['except'=>'show']);
    Route::get('admin/upload',[UploadController::class,'index']);
    Route::post('admin/upload/file',[UploadController::class,'uploadFile']);
    Route::delete('admin/upload/file',[UploadController::class,'deleteFile']);
    Route::post('admin/upload/folder',[UploadController::class,'createFolder']);
    Route::delete('admin/upload/folder',[UploadController::class,'deleteFolder']);
});
//登录  退出
Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class,'login']);
Route::get('/logout',[LoginController::class,'logout'])->name('logout');


Route::get('/contact',[ContactController::class,'showForm']);
Route::post('/contact',[ContactController::class,'sendContactInfo']);
Route::get('rss',[BlogController::class,'rss']);
Route::get('sitemap.xml',[BlogController::class,'siteMap']);
