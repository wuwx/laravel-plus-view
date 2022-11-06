<?php

namespace Wuwx\LaravelPlusView;

use Closure;
use Illuminate\Http\Testing\MimeType;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

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

        if (MimeType::get($_format)) {
            View::addExtension("$_format.php", "php");
            View::addExtension("$_format.blade.php", "blade");
        }

        $response = $next($request);

        if (MimeType::get($_format) && is_a($response, 'Illuminate\Http\Response')) {
            $original = $response->original;
            if (is_a($original, 'Illuminate\View\View')) {
                $path = $original->getPath();
                if (Str::endsWith($path, "$_format.php") || Str::endsWith($path, "$_format.blade.php")) {
                    $response->header('Content-Type', MimeType::get($_format));
                }
            }
        }

        return $response;
    }
}
