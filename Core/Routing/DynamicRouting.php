<?php
namespace Core\Routing;
use Core\Http\Request;

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


        $adminfile = $admin_dir. $controller . '.php';

        $sitefile = $dir. $controller . '.php';

        if(\file_exists($adminfile)){
            include_once($adminfile);
            $class = "App\\Controller\\Admin\\" . $controller;
            $controller = new $class();
   

            if($params){
          
                $controller->$action(implode(',', $params));
            }else{
                $controller->$action();
            }

        }elseif(\file_exists($sitefile)){
            include_once($sitefile);

            $class =  "App\\Controller\\" . $controller;
            $controller = new $class();
            $controller->$action();
        }

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
    
}