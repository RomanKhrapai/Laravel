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


Broadcast::routes(['prefix' => 'broadcasting', 'middleware' => ['auth']], function ($user, $id) {
    Log::info("message1");
    return $user->id === $id;
});

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    Log::info("message2");
    return (int) $user->id === (int) $id;
});

Broadcast::channel('send_message_{id}', function ($user, $id) {
    return $user->id === $id;
});
