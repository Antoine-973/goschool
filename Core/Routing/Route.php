<?php
namespace Core\Routing;

class Route{

    private $routes = [];

    /**
     * @param string $path
     * @param array $callback
     * @return void
     */
     public function get(string $path, array $callback)
     {
        $this->routes['get'][$path] = $callback;
        return $this;
        
     }

      /**
     * @param string $path
     * @param array $callback
     * @return void
     */
    public function post(string $path, array $callback)
    {
       $this->routes['post'][$path] = $callback;
       return $this;
       
    }

     public function getRoutes()
     {
        return $this->routes;

     }

     public function middleware()
     {
         foreach(\func_get_args() as $middleware){
            if($middleware == "auth"){
               echo "Need auth";
            }
         }
     } 
}