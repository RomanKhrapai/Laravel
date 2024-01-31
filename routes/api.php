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
use App\Http\Controllers\Api\Files\UploadApiImageController;
use App\Http\Controllers\Api\Files\UploadImageController;
use App\Http\Controllers\Auth\UpdateController;

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

Route::get('/parameters', [ApiFormParametersController::class, 'index']);
Route::get('/profession/search', [ApiProfessionController::class, 'search']);
Route::get('/area/search', [ApiAreaController::class, 'search']);



Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/uploadavatar', [UploadApiImageController::class, 'upload'])->name('api.uploadAvatar');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [ApiUserController::class, 'index']);
    Route::post('/update/password', [UpdateController::class, 'password']);

    // Route::post('/vac', 'App\Http\Controllers\Api\Vacancy\StoreController');

    Route::group(['namespace' => 'App\Http\Controllers\Api\Vacancy'], function () {
        Route::get('/vacancies', 'IndexController');
        Route::get('/vacancies/{vacancy}', 'ShowController');
        Route::post('/vacancies', 'StoreController');
        Route::patch('/vacancies/{vacancy}', 'UpdateController');
        Route::delete('/vacancies/{vacancy}', 'DeleteController');
    });

    Route::group(['namespace' => 'App\Http\Controllers\Api\Company'], function () {
        Route::get('/companies', 'IndexController');
        Route::get('/companies/{company}', 'ShowController');
        Route::post('/companies', 'StoreController');
        Route::patch('/companies/{company}', 'UpdateController');
        Route::delete('/companies/{company}', 'DeleteController');
    });
    Route::group(['namespace' => 'App\Http\Controllers\Api\Candidate'], function () {
        Route::get('/candidates', 'IndexController');
        Route::get('/candidates/{candidate}', 'ShowController');
        Route::post('/candidates', 'StoreController');
        Route::patch('/candidates/{candidate}', 'UpdateController');
        Route::delete('/candidates/{candidate}', 'DeleteController');
    });
    Route::group(['namespace' => 'App\Http\Controllers\Api\Review'], function () {
        Route::get('/reviews', 'IndexController');
        // Route::get('/reviews/{reviews}', 'ShowController');
        Route::post('/reviews', 'StoreController');
        Route::patch('/reviews/{review}', 'UpdateController');
        Route::delete('/reviews/{review}', 'DeleteController');
    });
});
// Route::post('/upload', [ImageAvatarUploadController::class, 'upload'])->name('api.uploadAvatar');

Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::post('/upload', [UploadImageController::class, 'upload'])->name('api.uploadAvatar');
    Route::get('/skillByProfesion', [ApiSkillController::class, 'byProfesion'])->name('api.skillByProfesion');
});
