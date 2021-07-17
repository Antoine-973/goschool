<?php
namespace App\Query;

use Core\Database\QueryBuilder;

class RoleQuery{

    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    /**
     * @return array $data
     */
    public function getRoles()
    {
        $query = $this->builder->select('role')->from("roles");
        return $query->getResult();
    }

    public function getIdbyName($role)
    {
        $query = $this->builder->select('id')->from("roles")->where("role = $role");
        return $query->getResult();
    }

}