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

        $session = Session::getSession();
        $id = $session->getMessage('user_id');


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
}