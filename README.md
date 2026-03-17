# Laravel Plus View

[![Latest Stable Version](https://poser.pugx.org/wuwx/laravel-plus-view/v/stable.png)](https://packagist.org/packages/wuwx/laravel-plus-view) [![Total Downloads](https://poser.pugx.org/wuwx/laravel-plus-view/downloads.png)](https://packagist.org/packages/wuwx/laravel-plus-view)

一个 Laravel 扩展包，让你的应用能够根据请求格式自动选择对应的视图模板，轻松实现多格式响应（HTML、JSON、XML、JS 等）。

## 功能特性

- 🎯 根据 `_format` 查询参数或 `Accept` 请求头自动选择视图模板
- 📦 支持多种格式：HTML、JSON、XML、JavaScript 等
- 🔧 自动设置正确的 `Content-Type` 响应头
- 🚀 零配置，安装即用（Laravel 5.5+ 自动发现）
- 💡 支持 Blade 模板和普通 PHP 模板

## 工作原理

该扩展通过中间件拦截请求，根据格式参数动态注册视图扩展名，使 Laravel 能够自动查找对应格式的视图文件。

例如，当请求 `?_format=json` 时，Laravel 会优先查找 `view.json.blade.php` 或 `view.json.php` 文件。

## 环境要求

- PHP 7.3 或更高版本（Laravel 13 需要 PHP 8.2+）
- Laravel 5.6 或更高版本（含 Laravel 13）

## 安装

通过 Composer 安装：

```bash
composer require wuwx/laravel-plus-view
```

### Laravel 5.5+

扩展包会通过 Package Discovery 自动注册，无需手动配置。

### Laravel 5.4 及以下版本

需要在 `config/app.php` 中手动注册服务提供者：

```php
'providers' => [
    // ...
    Wuwx\LaravelPlusView\LaravelPlusViewServiceProvider::class,
],
```

## 使用方法

### 创建多格式视图

在 `resources/views` 目录下创建不同格式的视图文件：

**resources/views/users/index.html.blade.php**
```blade
<!DOCTYPE html>
<html>
<head>
    <title>用户列表</title>
</head>
<body>
    <h1>用户列表</h1>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>
</body>
</html>
```

**resources/views/users/index.json.blade.php**
```blade
{!! json_encode($users) !!}
```

**resources/views/users/index.xml.blade.php**
```blade
<?xml version="1.0" encoding="UTF-8"?>
<users>
    @foreach($users as $user)
    <user>
        <id>{{ $user->id }}</id>
        <name>{{ $user->name }}</name>
    </user>
    @endforeach
</users>
```

**resources/views/users/index.js.blade.php**
```blade
var users = {!! json_encode($users) !!};
console.log(users);
```

### 控制器代码

控制器代码保持不变，只需返回视图：

```php
public function index()
{
    $users = User::all();
    return view('users.index', compact('users'));
}
```

### 请求示例

**方式一：使用 `_format` 查询参数**

```bash
# 返回 HTML 格式（默认）
curl http://localhost:8000/users

# 返回 JSON 格式
curl http://localhost:8000/users?_format=json

# 返回 XML 格式
curl http://localhost:8000/users?_format=xml

# 返回 JavaScript 格式
curl http://localhost:8000/users?_format=js
```

**方式二：使用 `Accept` 请求头**

```bash
# 返回 JSON 格式
curl http://localhost:8000/users -H "Accept: application/json"

# 返回 XML 格式
curl http://localhost:8000/users -H "Accept: application/xml"

# 返回 JavaScript 格式
curl http://localhost:8000/users -H "Accept: application/javascript"
```

## 支持的格式

扩展包支持所有 Laravel 内置的 MIME 类型，包括但不限于：

- `html` - text/html
- `json` - application/json
- `xml` - application/xml
- `js` - application/javascript
- `css` - text/css
- `txt` - text/plain
- `csv` - text/csv
- 等等...

## 视图文件命名规则

视图文件命名格式：`{视图名称}.{格式}.{扩展名}`

- Blade 模板：`index.json.blade.php`
- 普通 PHP 模板：`index.json.php`

## 测试

运行测试套件：

```bash
composer test
```

或

```bash
vendor/bin/phpunit
```

## 许可证

MIT License. 详见 [LICENSE](LICENSE) 文件。
