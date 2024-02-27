<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web;

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

Route::get('/auth/redirect', [LoginController::class, 'redirectGoogle'])->name('authGoogle');
Route::get('/auth/callback', [LoginController::class, 'callbackGoogle']);

Route::group(['namespace' => 'App\Http\Controllers\Web'], function () {
    Route::middleware(['auth'])->group(function () {
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('areas', 'AreaController');
        Route::resource('professions', 'ProfessionController');
        Route::resource('types', 'TypeController');
        Route::resource('natures', 'NatureController');
        Route::resource('skills', 'SkillController');
        Route::resource('vacancies', 'VacancyController');
        Route::resource('candidates', 'CandidateController');
        Route::resource('companies', 'CompanyController');
        Route::resource('reviews', 'ReviewController');

        Route::get('/', 'HomeController')->name('home');
    });
});
