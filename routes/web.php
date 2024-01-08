<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyTestController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\VacancyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});



// Route::get('/user', [UserController::class, 'index']);


Route::controller(MyTestController::class)->group(function () {
    Route::get('/test1', 'index');
});
// Route::get('/test1', 'MyTestController@index');

Route::get('/auth', function () {
    return "autorisation page";
});

// Route::get('user', [UserController::class, 'index']);
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('areas', AreaController::class);
Route::resource('categories', CategoryController::class);
Route::resource('languages', LanguageController::class);
Route::resource('types', TypeController::class);
Route::resource('natures', NatureController::class);
Route::resource('skills', SkillController::class);
Route::resource('vacancy', VacancyController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
