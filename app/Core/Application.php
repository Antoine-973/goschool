<?php
namespace Core;
use Core\Router;
use Core\Http\Request;
use Core\Http\Response;
use Core\Database\DB;

class Application
{

    public function __construct(){

        //DATABASE Connection
        $db = new DB();

        //HTTP Handling & Routing
        $request = new Request();
        $response = new Response();

        $path = $request->getUrl();
        $params = $request->getParams();

        $router =  new Router();

        if(!empty($params)){
            $router->resolve($path, $params);
        }
        $router->resolve($path);
    }

}