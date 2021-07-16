<?php
namespace Core\Util;

use App\Query\HavePermissionQuery;
use App\Query\PermissionQuery;
use App\Query\RoleQuery;
use App\Query\UserQuery;

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
}