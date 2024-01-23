<?php

use App\Http\Controllers\Api\ApiAreaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiSkillController;
use App\Http\Controllers\Api\ImageAvatarUploadController;
use App\Http\Controllers\Api\ApiFormParametersController;
use App\Http\Controllers\Api\ApiProfessionController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\Vacancy\ShowController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/parameters', [ApiFormParametersController::class, 'index']);
    Route::get('/profession/search', [ApiProfessionController::class, 'search']);
    Route::get('/area/search', [ApiAreaController::class, 'search']);
    Route::get('/user', [ApiUserController::class, 'index']);
    // Route::resource('vacancies', VacancyController::class);

    Route::post('/vac', 'App\Http\Controllers\Api\Vacancy\StoreController');

    Route::group(['namespace' => 'App\Http\Controllers\Api\Vacancy'], function () {
        Route::get('/vacancies/{vacancy}', 'ShowController');
        Route::post('/vacancies', 'StoreController');
        Route::patch('/vacancies/{vacancy}', 'UpdateController');
    });
});

Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::get('/skillByProfesion', [ApiSkillController::class, 'byProfesion'])->name('api.skillByProfesion');
    Route::post('upload', [ImageAvatarUploadController::class, 'upload'])->name('api.uploadAvatar');
});
