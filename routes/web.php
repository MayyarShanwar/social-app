<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::redirect('/','posts');
//we use the resource function so we don't have to whrite all the route in PostController class if we check 'php artisan route:list' all the needed routes will be automatically added
Route::resource('posts',PostController::class);
//{} this in a route means it is dynamic and should be passed in the view
Route::get('/{user}/posts',[DashboardController::class , 'userPosts'])->name('posts.user');

Route::middleware('guest')->group(function () {

Route::view('/register','auth.register')->middleware('guest')->name('register');
Route::view('/login','auth.login')->name('login');
Route::post('/register',[AuthController::class , 'register']);
Route::post('/login',[AuthController::class , 'login']);
});

//by using middleware we allow only auth users to go to dashboard and guests would go to the log in page

Route::middleware('auth')->group(function () {
Route::post('/logout',[AuthController::class , 'logout'])->name('logout');
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

});