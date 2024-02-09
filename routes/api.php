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
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['AuthMod'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {

        Route::get('/vacancies', 'Vacancy\IndexController');
        Route::get('/vacancies/{vacancy}', 'Vacancy\ShowController');

        Route::get('/companies', 'Company\IndexController');
        Route::get('/companies/{company}', 'Company\ShowController');

        Route::get('/reviews', 'Review\IndexController');
    });
});

Route::get('/parameters', [ApiFormParametersController::class, 'index']);
Route::get('/professions/search', [ApiProfessionController::class, 'search']);
Route::get('/profession/{profession}', [ApiProfessionController::class, 'byId']);
Route::get('/area/{area}', [ApiAreaController::class, 'byId']);
Route::get('/areas/search', [ApiAreaController::class, 'search']);





Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/uploadavatar', [UploadApiImageController::class, 'upload'])->name('api.uploadAvatar');
    Route::get('/user', [ApiUserController::class, 'index']);

    Route::patch('/update/password/{user}', [UpdateController::class, 'password']);
    Route::patch('/update/user/{user}', [UpdateController::class, 'user']);

    Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
        Route::get('/chats', 'Chat\IndexController');
        Route::post('/chats', 'Chat\CreateController');
        Route::get('/messages', 'Chat\MessageController');
        Route::get('/chats/{chat}', 'Chat\ShowController');
        Route::post('/chats/{chat}', 'Chat\SendController');

        Route::post('/vacancies', 'Vacancy\StoreController');
        Route::patch('/vacancies/{vacancy}', 'Vacancy\UpdateController');
        Route::delete('/vacancies/{vacancy}', 'Vacancy\DeleteController');

        Route::post('/companies', 'Company\StoreController');
        Route::patch('/companies/{company}', 'Company\UpdateController');
        Route::delete('/companies/{company}', 'Company\DeleteController');

        Route::get('/candidates', 'Candidate\IndexController');
        Route::get('/candidates/{candidate}', 'Candidate\ShowController');
        Route::post('/candidates', 'Candidate\StoreController');
        Route::patch('/candidates/{candidate}', 'Candidate\UpdateController');
        Route::delete('/candidates/{candidate}', 'Candidate\DeleteController');

        Route::post('/reviews', 'Review\StoreController');
        Route::patch('/reviews/{review}', 'Review\UpdateController');
        Route::delete('/reviews/{review}', 'Review\DeleteController');

        Route::get('/reports/feedback', 'Report\FeedbackController');
        // Route::get('/reports/vacancy', 'Report\VacancyController');

    });
});

Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::post('/upload', [UploadImageController::class, 'upload'])->name('api.upload');
    Route::get('/skillByProfesion', [ApiSkillController::class, 'byProfesion'])->name('api.skillByProfesion');
});
