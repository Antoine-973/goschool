<?php
namespace Core\Routing;
use App\Query\ArticleQuery;
use App\Query\PageQuery;
use Core\Http\Request;
use Core\Middleware\AuthMiddleware;
use App\Controller\Admin\AdminAuthController;

class DynamicRouting {

    public function dispatch()
    {
        
        $request = new Request();
        $path = trim($request->getPath(), '/');
        $arr = explode('/', $path);

            $request = new Request();
            $path = trim($request->getPath(), '/');

            $controller = $this->getController($path);
            $action = $this->getAction($path);
            $params = $this->getParams($path);

            $admin_dir = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . 'Admin' .DIRECTORY_SEPARATOR; 

        $adminfile = $admin_dir. $controller . '.php';
        $sitefile = $dir. $controller . '.php';


        if (\file_exists($adminfile)){
            if (method_exists("App\\Controller\\Admin\\" . $controller, $action)) {

            }
            else{
                $this->resolve404();
            }
        }
        elseif ($controller != 'HomeController'){
            $this->resolve404();
        }

        if(AuthMiddleware::adminRoute($path)){
          AuthMiddleware::isAuth();
        }

        $this->resolveAdmin($adminfile, $controller, $action, $params);
        $this->resolveSite($sitefile, $controller, $action, $params);
        
            $this->resolveAdmin($adminfile, $controller, $action, $params);
            $this->resolveSite($sitefile, $controller, $action, $params);
        
    }


    public function getAction($path)
    {
        $arr = explode('/', $path);
        if ($arr[0] == 'admin'){
            if(count($arr) >= 3) {
                $action =  $arr[2];
            }
            else{
                $action = '';
            }
        }
        elseif($arr[0] == 'article' && count($arr) > 2){
            if ($arr[2] == 'storeComment'){
                $action =  $arr[2];
            }
        }
        elseif($arr[0] == 'article'){
            $action =  $arr[0];
        }
        else{
            $action =  'index';
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
                $controller = 'HomeController';
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

    public function resolveAdmin($file, $controller, $action, $params)
    {
        if(\file_exists($file)){
            include_once($file);
            $class = "App\\Controller\\Admin\\" . $controller;
            $controller = new $class();

            if (method_exists($controller,$action)){
                if($params){
                    $controller->$action(implode(',', $params));
                }else{
                    $controller->$action();
                }
            }
            else{
                $this->resolve404();
            }
        }
        elseif ($controller == 'HomeController'){

        }
        else{
            $this->resolve404();
        }
    }

    public function resolveSite($file, $controller, $action, $params)
    {
        if(\file_exists($file)){
            include_once($file);

            $request = new Request();
            $path = trim($request->getPath(), '/');
            $arr = explode('/', $path);
            if (count($arr) >= 2 && $arr[1] == 'storeComment'){
                $action = 'storeComment';
            }

            $articleQuery = new ArticleQuery();
            $pageQuery = new PageQuery();

            if ($request->isPost()){
                $data = $request->getBody();
                $slug = $data['slug'];
            }else{
                if ($arr[0] == 'article' && count($arr) > 1){
                    $slug = $arr[1];
                }
            }

            if ($arr[0] == 'article' && count($arr) > 1){
                if ($articleQuery->getArticleBySlug($slug)){
                    $class =  "App\\Controller\\" . $controller;
                    $controller = new $class();
                    if($params){
                        $controller->$action(implode(',', $params));
                    }else{
                        $controller->$action();
                    }
                }
                else{
                    $this->resolve404();
                }
            }
            elseif ($pageQuery->getPageByUrl('/' . $arr[0])){
                $class =  "App\\Controller\\" . $controller;
                $controller = new $class();
                if($params){
                    $controller->$action(implode(',', $params));
                }else{
                    $controller->$action();
                }
            }
            else{
                $this->resolve404();
            }
        }
    }

    public function resolve404(){
        $class =  "App\\Controller\\ErrorController";
        $controller = new $class();
        $action ='error404';

        $controller->$action();
    }
    
}