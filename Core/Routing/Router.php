<?php
/*
namespace Core\Routing;
use Core\Controller;
 use Core\Http\Request;
 use Core\Http\Response;

 class Router extends Controller{

    private array $routes = [];

    private Request $request;

    private Response $response;

    private static $instance = null;

    public function __construct($routes){

        $this->request = new Request();
        $this->response = new Response();
        $this->routes = $routes;
    }

     public  function resolve(string $url = null)
     {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        

        $controller_class = "App\\Controller\\" . $callback['controller'];
        $method = $callback['method'];

        $contrellerFile = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR . $callback['controller'] . ".php";
 
        if (strpos($path, 'admin') !== false) {
            
            $contrellerFile = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR . "Admin" . DIRECTORY_SEPARATOR . $callback['controller'] . ".php";
            $controller_class  = "App\\Controller\\Admin\\" . $callback['controller'];
        }
       
        if(file_exists($contrellerFile)){
            require_once $contrellerFile;
            
            $controller = new  $controller_class();
            
            if(method_exists($controller, $method)){
                $controller->$method();
            }

        }
    
     }

    protected function methodHasParamters($controller, $method){

        $reflexion  = new \ReflectionMethod($controller, $method);
        $params = $reflexion->getParameters();

        return !empty($params) ? true : false;

    }
 } 
*/