<?php
namespace Core\Middleware;
use Core\Http\Request;

class InstallMiddleware
{
    public static function check()
    {
        $envFile = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . '.env';

        if(!file_exists($envFile)){
            return true;
        }

        return false;
    }

    public static function install()
    {
        $request = new Request();
        $request->redirect('/installation/index');
        exit;
    }
}