<?php
namespace App\Query;

use Core\Database\QueryBuilder;

class HavePermissionQuery{

    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    public function getPermissionByRoleId($roleId)
    {
        $query = $this->builder->select("permissions.authorization")->from("havePermission")->join('INNER', 'havePermission', 'role_id', 'roles', 'id')->join('INNER', 'havePermission', 'permission_id', 'permissions', 'id')->where("role_id = $roleId");
        return $query->getResult();
    }

}