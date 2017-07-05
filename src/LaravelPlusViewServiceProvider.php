<?php
namespace Wuwx\LaravelPlusView;

use Illuminate\Support\ServiceProvider;

class LaravelPlusViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware(LaravelPlusViewMiddleware::class);
    }

    public function register()
    {
        //
    }
}
