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

    private static array $routes = [];

    private static Request $request;

    private static Response $response;

    private static $instance = null;

    /**
     * @param array $routes
     */
    public function __construct($routes){

        self::$request = new Request();
        self::$response = new Response();
        self::$routes = $routes;
    }


     /**
      * @return void
      */
     public  function resolve(string $url = null)
     {
        self::$request = new Request();

        if(!self::envFileExists()){
            $method = self::$request->getMethod();
            $callback = self::$routes[$method]['/install'] ?? false;
            exit(self::resolveCallBack($callback));
        }
        
        $path = ($url) ? $url : self::$request->getPath();
        $method = self::$request->getMethod();

        $callback = self::$routes[$method][$path] ?? false;
        exit(self::resolveCallBack($callback, $path));
    
        
     }

    protected function methodHasParamters($controller, $method){

        $reflexion  = new \ReflectionMethod($controller, $method);
        $params = $reflexion->getParameters();

        return !empty($params) ? true : false;

    }

    protected static function envFileExists()
    {
        $envFile = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . ".env";

        if(file_exists($envFile)){
            return true;
        }
        return false;
    }

    protected static function resolveCallBack($callback = false, $path = null)
    {
     
        if($callback === false){
            return;
        }

        $controller_class = "App\\Controller\\" . $callback['controller'];
        $method = $callback['method'];

        $contrellerFile = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR . $callback['controller'] . ".php";
 
        if ($path && strpos($path, 'admin') !== false) {
            
            $contrellerFile = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR . "Admin" . DIRECTORY_SEPARATOR . $callback['controller'] . ".php";
            $controller_class  = "App\\Controller\\Admin\\" . $callback['controller'];
        }
       
        if(file_exists($contrellerFile)){
            require_once $contrellerFile;
            
            $controller = new  $controller_class();
            
            if(method_exists($controller, $method)){
               exit($controller->$method());
                
            }

        }
    }

    public static function getRouter()
    {
        if(is_null(self::$instance)){
            self::$instance = new Router();
        }

        return self::$instance;
    }
 }