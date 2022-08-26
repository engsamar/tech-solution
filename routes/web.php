<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProblemsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommonProblemsController;

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



Route::post('/login', [LoginController::class,'postLogin'])->name('login');
Route::get('/login', [LoginController::class,'showLoginForm'])->name('showLogin');
Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', [LoginController::class,'logout'])->name('logout');
    Route::get('/', [LoginController::class,'home'])->name('home');
    Route::get('/profile', [LoginController::class,'profile'])->name('profile');
    Route::post(
        '/profile',
        [LoginController::class,'updateProfile']
    )->name('profile.update');

    Route::resource('users', UsersController::class);
    Route::resource('employees', EmployeesController::class);

    Route::resource('chats', ChatsController::class);
    Route::resource('problems', ProblemsController::class);
    Route::resource('common_problems', CommonProblemsController::class);
    //common_problems

    Route::get(
        'problems/change-status/{id}',
        [ProblemsController::class,'changeStatus']
    )->name('problems.chang-status');

    Route::get(
        'problems/change-important/{id}',
        [ProblemsController::class,'changeImportant']
    )->name('problems.chang-important');


    Route::resource(
        'categories',
        CategoriesController::class
    );
});
