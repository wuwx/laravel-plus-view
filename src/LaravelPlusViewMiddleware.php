<?php

namespace Wuwx\LaravelPlusView;

use Closure;
use Illuminate\Http\Testing\MimeType;
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
            $original = $response->original;
            if (is_a($original, 'Illuminate\View\View')) {
                $path = $original->getPath();
                if (ends_with($path, "$_format.php") || ends_with($path, "$_format.blade.php")) {
                    $response->header('Content-Type', MimeType::get($_format));
                }
            }
        }

        return $response;
    }
}
