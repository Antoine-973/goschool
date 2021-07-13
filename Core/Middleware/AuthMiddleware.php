<?php
namespace Core\Middleware;
use App\Query\UserQuery;
use Core\Http\Session;
class AuthMiddleware {
    
    public static function check()
    {
        $userQuery = new UserQuery();
        $session = new Session();

        $userFromSession = $session['user'] ?? null;

        if($userFromSession){

            $user = $userQuery->getUserById($userFromSession['id']);

            if($user && $user['role'] = 'admin'){
                return true;
            }
        }


        return false;
    }

   
}