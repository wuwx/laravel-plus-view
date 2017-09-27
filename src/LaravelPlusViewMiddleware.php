<?php

namespace Wuwx\LaravelPlusView;

use Closure;
use Illuminate\Support\Facades\View;

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
        $_format = $request->get('_format') ?: $request->format();
        if (array_get(MimeType::get(), $_format)) {
            View::addExtension("$_format.php", "php");
            View::addExtension("$_format.blade.php", "blade");
        }

        $response = $next($request);

        if (array_get(MimeType::get(), $_format)) {
            if ($response->status() == '200') {
                $response->header('Content-Type', MimeType::get($_format));
            }
        }

        return $response;
    }
}
