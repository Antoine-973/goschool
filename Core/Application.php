<?php
namespace Core;

/**
 * @class Core\Application
 * @author Christian Mohindo
 */

use Core\Routing\Router;
use Core\Http\Request;
use Core\Database\DB;

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
    public function __construct($routes)
    {

        $this->router = new Router($routes);
    
        
    }

    public function run()
    {
        $this->router->resolve();
    }

    public function getStatus()
    {
        return $this->status;
    }
}