<?php

namespace App\Http\Middleware;

use Closure;

class JsonRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->getContentType() != 'json')
        {
            return response('Method not allowed.', 405);
        }

        return $next($request);
    }
}
