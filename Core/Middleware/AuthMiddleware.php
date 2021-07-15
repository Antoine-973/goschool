<?php
namespace Core\Middleware;
use App\Query\UserQuery;
use Core\Http\Session;
use Core\Http\Request;

class AuthMiddleware {

    public static function adminRoute($path)
    {
        $arr = explode("/", $path);

        if(in_array('admin', $arr)){
            $params = \array_diff($arr, ['admin']);

           if(\in_array('auth', $params)){
               return false;
           }else{
               return true;
           }
        }
    }

    public static function isAuth()
    {
        $session = new Session();

        $request = new Request();

        if (!$session->getSession('user_id')){
            $request->redirect('/admin/auth/login');
            exit;
         }

         return true;
    }

   
}