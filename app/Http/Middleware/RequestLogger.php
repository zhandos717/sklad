<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestLogger
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
        Log::channel('requests')->info(json_encode([
            'url' => $request->getRequestUri(),
            'method' => $request->method(),
            'input' => $request->input(),
            'body' => $request->json(),
            'header' => $request->header()
        ], JSON_PRETTY_PRINT));

        return $next($request);
    }
}
