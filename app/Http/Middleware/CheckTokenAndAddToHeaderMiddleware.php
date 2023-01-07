<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckTokenAndAddToHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $all = $request->all();
        if (isset($all['access_token'])) {
            Log::debug('token from http param', [$all['access_token']]);
            $request->headers->set('Authorization', sprintf('%s %s', 'Bearer', $all['access_token']));
        }
        return $next($request);
    }
}
