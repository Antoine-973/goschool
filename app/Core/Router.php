<?php
namespace Core;
use Core\Exception\Exception;
use Core\Http\Request;
use Core\Http\Response;
use Core\Application;
class Router
{
    /**
     * @var array|mixed
     */
    protected  $routes = [];
    protected $controller = "DefaultController";
    protected $method = "index";
    protected $params = [];

    public function __construct(){

        $routesFile =  dirname(__DIR__) . "/config/routes.yml";
        $this->routes = yaml_parse_file($routesFile);

    }

    public function resolve($path, $params = []){

            $route = $this->getRoute($path);

            $class = "Controller\\" . $route['controller'];

            if(strpos(strtolower($route['controller']), 'admin') !== false){
                $class = "Controller\\Admin\\" . $route['controller'];
                $controller_file = dirname(__DIR__) . DIRECTORY_SEPARATOR ."Controllers" . DIRECTORY_SEPARATOR . "Admin" . DIRECTORY_SEPARATOR .$route['controller'] . ".php";
            }
          
            //$controller_file = dirname(__DIR__) . DIRECTORY_SEPARATOR ."Controllers" . DIRECTORY_SEPARATOR .$route['controller'] . ".php";
       
            $method = $route['method'];

           
            if(file_exists($controller_file)){
              
                include $controller_file;

                $controller = new $class();

                if(method_exists($controller, $method)){

                    (!empty($params) && $this->methodHasParamters($controller, $method)) ? \call_user_func_array($method, $params) : $controller->$method();

                }
            }


    }

    public function getRoute($path){

        try{

            if(array_key_exists($path, $this->routes)){
                return $this->routes[$path];
            }else{

                $response = new Response();
                $response->setStatusCode(404);
                throw new Exception($response->getStatusCode() . " - route doesnt exist");
            }
    
        }catch(Exception $e){
            echo $e->getMessage();
        }

    }

    public function getPath($controller, $method = ""){

        if(!empty($method)){
            $path = "/" . strtolower(str_replace("Controller", "",$controller)) . "/" . strtolower($method);
        }else{
            $path = "/" . strtolower(str_replace("Controller", "",$controller));
        }

        if($path === "/default" || $path === "/home"){
            $path = "/";
        }

        if(array_key_exists($path, $this->routes)){
            return $path;
        }

    }

    protected function methodHasParamters($controller, $method){

        $reflexion  = new \ReflectionMethod($controller, $method);
        $params = $reflexion->getParameters();

        return !empty($params) ? true : false;

    }

}