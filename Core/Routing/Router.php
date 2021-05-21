<?php
namespace Core\Routing;
use Core\Controller;

/**
 * class Router
 * 
 * @auhtor Christian Mohindo
 * @package Core
 */

 use Core\Http\Request;
 use Core\Http\Response;

 class Router extends Controller{

    private array $routes = [];

    private Request $request;

    private Response $response;

    /**
     * @param array $routes
     */
    public function __construct($routes){

        $this->request = new Request();
        $this->response = new Response();
        $this->routes = $routes;
    }


     /**
      * @return void
      */
     public function resolve()
     {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        
        if($callback === false){
            return;
        }

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