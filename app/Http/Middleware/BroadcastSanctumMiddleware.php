<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class BroadcastSanctumMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        Log::info('test1 ' . $request);
        $request->headers->add(['Authorization' => '8|t8Q1W1YHuaOOuRCIH0e8RHjAEQv5UAlJxWCUcxice7636458']);

        Log::info('test2 ' . Auth::check());
        Log::info('test3 ' . Auth::guard('sanctum')->check());
        $string = json_encode($request->query());
        Log::info('test4 ' . $string);
        Log::info('test5 ' . $request);

        if (Auth::guard('sanctum')->check()) {
            Auth::setUser(Auth::guard('sanctum')->user());
        }

        return $next($request);
    }
}
