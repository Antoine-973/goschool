<?php
namespace Core\Http;
use Core\Routing\Router;
use Core\Routing\Route;
class Redirect
{
    public static function to(string $route)
    {
        $routes = Route::getRoutes();
        $router = new Router($routes);
        exit($router::resolve($route));
    }
}