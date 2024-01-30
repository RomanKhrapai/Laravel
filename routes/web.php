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
use App\Http\Controllers\Auth\LoginController;

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
//      http://127.0.0.1:8080/auth/callback

Route::get('/auth/redirect', [LoginController::class, 'redirectGoogle'])->name('authGoogle');
Route::get('/auth/callback', [LoginController::class, 'callbackGoogle']);


Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('professions', ProfessionController::class);
    Route::resource('languages', LanguageController::class);
    Route::resource('types', TypeController::class);
    Route::resource('natures', NatureController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('vacancies', VacancyController::class);
    Route::resource('candidates', CandidateController::class);
    Route::resource('companies', CompanyController::class);

    Route::get('/', function () {
        return view('home');
    })->name('home');
});
