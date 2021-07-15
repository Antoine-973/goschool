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
use Core\Middleware\AuthMiddleware;
use Core\Util\Helper;
class Application{
    
    /**
    * @var Core\Router
    */
    public Router $router;
  
    /**
    * @var Core\DB
    */
    public $request;

    private $auth = false;

    /**
     * @param array $routes
     * @param array $db_config
     */
    public function __construct()
    {

        $this->request = new Request();
    
        
    }

    public function run()
    {
        $router =  new DynamicRouting();

        $path = $this->request->getPath();

        $helper = new Helper();

        if(!AuthMiddleware::check($path)){
            $helper->view('admin/registration/login.phtml');
        }
        $router->dispatch();
    }

    public function getStatus()
    {
        return $this->status;
    }
}