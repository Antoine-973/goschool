<?php
namespace Core;

/**
 * @class Core\Application
 * @author Christian Mohindo
 */

use Core\Routing\Router;
use Core\Http\Request;
use Core\Database\DB;
use Core\Routing\DynamicRouting;
class Application{
    
    /**
    * @var Core\Router
    */
    public Router $router;
  
    /**
    * @var Core\DB
    */
    public $connection;

    private $status = false;

    /**
     * @param array $routes
     * @param array $db_config
     */
    public function __construct()
    {

        //$this->router = new Router($routes);
    
        
    }

    public function run()
    {
        $router =  new DynamicRouting();
        $router->dispatch();
    }

    public function getStatus()
    {
        return $this->status;
    }
}