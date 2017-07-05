<?php

namespace Wuwx\LaravelPlusView;

use Closure;

class LaravelPlusViewMiddleware
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
        $response = $next($request);
        if ($response->status() == '200') {
            switch ($request->format()) {
                case 'json':
                    $response->header('Content-Type', 'application/json');
                    break;
                case 'xml':
                    $response->header('Content-Type', 'application/xml');
                    break;
            }
        }
        return $response;
    }
}
