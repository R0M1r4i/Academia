<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CacheCss
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($request->is('assets/vendor/css/core.css')) {
            $response->header('Cache-Control', 'public, max-age=2592000');
        }

        return $response;
    }
}
