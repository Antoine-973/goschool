<?php
namespace Core\Routing;
use Core\Http\Request;
use Core\Middleware\AuthMiddleware;
use Core\Middleware\InstallMiddleware;
use App\Controller\Admin\AdminAuthController;
use Core\Http\Session;
class DynamicRouting {

    public function dispatch()
    {
        
        $request = new Request();
        $path = trim($request->getPath(), '/');

        $controller = $this->getController($path);
        $action = $this->getAction($path);
        $params = $this->getParams($path);

        $admin_dir = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . 'Admin' .DIRECTORY_SEPARATOR; 

        $dir = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR;


        if(AuthMiddleware::adminRoute($path)){
          AuthMiddleware::isAuth();
        }

        if(!InstallMiddleware::checkInstallation()){
            InstallMiddleware::install();
        }

        $adminfile = $admin_dir. $controller . '.php';
        $sitefile = $dir. $controller . '.php';

        $this->resolveAdmin($adminfile, $controller, $action, $params);
        $this->resolveSite($sitefile, $controller, $action, $params);
        
    }


    public function getAction($path)
    {
        $arr = explode('/', $path);
        $action = 'index';

        if(count($arr) >= 2){
            if($arr[0] == 'admin'){
                $action =  $arr[2];
            }else{
                $action =  $arr[1];
            }
        }

        return $action;
    }

    public function getController($path)
    {
        $arr = explode('/', $path);
        $controller = 'HomeController';

        if(count($arr) >= 2){

            if($arr[0] == 'admin'){
                $controller =  'Admin' . ucfirst($arr[1]) . 'Controller';
            }else{
                $controller = ucfirst($arr[0]) . 'Controller';
            }
        }

        return $controller;
    }

    public function getParams($path)
    {   
        $arr = explode('/', $path);



        if(count($arr) >= 3){
            $params = [];
            if($arr[0] == 'admin'){
                $params =  array_slice($arr, 3);
            }else{
                $params =  array_slice($arr, 2);
            }

            return $params;
        }
    }

    public function resolveAdmin($file, $controller, $action, $params)
    {
        if(\file_exists($file)){
            include_once($file);
            $class = "App\\Controller\\Admin\\" . $controller;
            $controller = new $class();
            
            if($params){
          
                $controller->$action(implode(',', $params));
                }else{
                    $controller->$action();
                }
            }
    }

    public function resolveSite($file, $controller, $action, $params)
    {

        if(\file_exists($file)){
            include_once($file);

            $class =  "App\\Controller\\" . $controller;
            $controller = new $class();
            if($params){
          
                $controller->$action(implode(',', $params));
            }else{
                $controller->$action();
            }
        }
    }
    
}