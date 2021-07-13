<?php
namespace Core\Middleware;
use App\Query\UserQuery;
use Core\Http\Session;
class AuthMiddleware {
    
    public static function check($path)
    {
        if(self::adminRoute($path)){

            $userQuery = new UserQuery();
            $session = new Session();

            $userFromSession = $session->getMessage('user') ?? null;

            if($userFromSession){

                $user = $userQuery->getUserById($userFromSession['id']);
    
                if($user && $user['role'] = 'admin'){
                    return true;
                }
            }
    
        }

        return false;
    }

    public static function adminRoute($path)
    {
        $arr = explode("/", $path);

        if(in_array('admin', $arr)){
           if(\in_array('index', $arr) || \in_array('register', $arr)){
               return false;
           }else{
               return true;
           }
        }
    }

   
}