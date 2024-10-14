<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerate();
    return redirect()->route('welcome')->with('success', 'You have been logged out');
})->name('logout');


Route::get('/registration',[UserController::class,'create']);
Route::get('/login',[UserController::class,'index']);
Route::get('/logout',[UserController::class,'update'])->middleware('auth');
 


Route::resource('users',UserController::class)->except(['edit','destroy','show']);
Route::resource('tasks',TaskController::class)->middleware('auth');

Route::resource('users.tasks', UserController::class)->middleware('auth');
