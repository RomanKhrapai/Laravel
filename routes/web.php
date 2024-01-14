<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CandidateController;

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


Route::resource('users', UserController::class)->middleware('auth');
Route::resource('roles', RoleController::class)->middleware('auth');
Route::resource('areas', AreaController::class)->middleware('auth');
Route::resource('professions', ProfessionController::class)->middleware('auth');
Route::resource('languages', LanguageController::class)->middleware('auth');
Route::resource('types', TypeController::class)->middleware('auth');
Route::resource('natures', NatureController::class)->middleware('auth');
Route::resource('skills', SkillController::class)->middleware('auth');
Route::resource('vacancies', VacancyController::class)->middleware('auth');
Route::resource('candidates', CandidateController::class)->middleware('auth');
Route::resource('companies', CompanyController::class)->middleware('auth');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
