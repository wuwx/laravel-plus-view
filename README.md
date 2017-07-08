# laravel-plus-view

[![Latest Stable Version](https://poser.pugx.org/wuwx/laravel-plus-view/v/stable.png)](https://packagist.org/packages/wuwx/laravel-plus-view) [![Total Downloads](https://poser.pugx.org/wuwx/laravel-plus-view/downloads.png)](https://packagist.org/packages/wuwx/laravel-plus-view)

## Installation

### Quick

To install through composer, simply run the following command:

``` bash
composer require wuwx/laravel-plus-view
```

#### Add Service Provider

Next add the following service provider in `config/app.php`.

``` php
'providers' => [
    Wuwx\LaravelPlusView\LaravelPlusViewServiceProvider::class,
],
```

#### Add Blade Template

`index.html.blade.php`
``` blade
<h1>{{ $dataTypeContent->title }}</h1>
```

`index.json.blade.php`
``` blade
{!! json_encode($dataTypeContent) !!}
```

### Test

``` bash
curl http://localhost:8000/users
curl http://localhost:8000/users?_format=json
curl http://localhost:8000/users -H "Accept: application/json"
```
