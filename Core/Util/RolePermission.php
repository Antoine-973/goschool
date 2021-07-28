<?php
namespace Core\Util;

use App\Query\ArticleQuery;
use App\Query\HavePermissionQuery;
use App\Query\PageQuery;
use App\Query\PermissionQuery;
use App\Query\RoleQuery;
use App\Query\UserQuery;
use Core\Http\Session;

class RolePermission{

    public function has_permission($id, $authorization){

        $userQuery = new UserQuery();
        $roleQuery = new RoleQuery();
        $permissionQuery = new PermissionQuery();
        $havePermissionQuery = new HavePermissionQuery();

        $roleId = $userQuery->getRoleIdById($id)['id'];

        $table = new Table();
        $permissionOfRole = $table->multi_to_single($havePermissionQuery->getPermissionByRoleId($roleId));

        if (is_array($authorization)){

            if(array_intersect($authorization, $permissionOfRole) == $authorization){
                return true;
            }
            else{
                return false;
            }

        }else{
            if (in_array($authorization,$permissionOfRole)){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function canEditOrDelete($articleId, $typeOfContent){

        $session = new Session();
        $id = $session->getSession('user_id');


        if ($this->has_permission($id,'crud_'.$typeOfContent)){
            return true;
        }
        elseif($typeOfContent == 'page'){

            $pageQuery = new PageQuery();

            if ($id == $pageQuery->getAuthor($articleId)['user_id']){
                return true;
            }
            else{
                return false;
            }
        }
        elseif ($typeOfContent == 'article'){

            $articleQuery = new ArticleQuery();

            if ($id == $articleQuery->getAuthor($articleId)['user_id']){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function canAddUser($userRole){
        $session = new Session();
        $myId = $session->getSession('user_id');

        $roleQuery = new UserQuery();
        $myRole = $roleQuery->getRoleId($myId)['role_id'];

        if ($myRole < $userRole){
            return true;
        }else{
            return false;
        }
    }


    public function canEditOrDeleteUser($userId){

        $session = new Session();
        $myId = $session->getSession('user_id');

        $roleQuery = new UserQuery();
        $userRole = $roleQuery->getRoleId($userId)['role_id'];

        $roleQuery = new UserQuery();
        $myRole = $roleQuery->getRoleId($myId)['role_id'];

        if ($this->has_permission($myId,'crud_user')){
            if ($myRole < $userRole){
                return true;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }
}