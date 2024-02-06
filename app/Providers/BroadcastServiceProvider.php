<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        Log::info('test ' . $request);
        // Broadcast::routes();
        Broadcast::routes(['middleware' => ['BroadcastSanctum']]);
        require base_path('routes/channels.php');
    }
}
