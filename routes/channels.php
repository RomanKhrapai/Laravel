<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\ChatChannel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Route::post('/broadcasting/auth', function ($user, $userId) {
//     return $user->id === $userId;
// });
// Broadcast::routes(['middleware' => ['auth:sanctum']]);
Broadcast::routes(['prefix' => 'broadcasting', 'middleware' => ['auth']], function ($user, $id) {
    Log::info("message1");
    return $user->id === $id;
});

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    Log::info("message2");
    return (int) $user->id === (int) $id;
});


// Broadcast::channel('channel-name', function ($user, $userId) {
//     return $user->id === (int) $userId;
// });

// Broadcast::channel('private-send_message_.{id}', function ($user, $id) {
//     return (int) Auth()->user->id === (int) $id;
// });
Broadcast::channel('send_message_{id}', function ($user, $id) {

    Log::info("message1 " . $user);
    Log::info("message3 " . $id);
    Log::info("message4 " . Auth::guard('sanctum')->user());
    Log::info("message5 " . Auth::user());
    return $user->id === $id;
});
Route::middleware(['AuthMod'])->group(function () {
});
