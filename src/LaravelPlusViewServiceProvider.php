<?php
namespace Wuwx\LaravelPlusView;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LaravelPlusViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $_format = Request::format();
        View::addExtension("$_format.blade.php", "blade");
    }

    public function register()
    {
        //
    }
}
