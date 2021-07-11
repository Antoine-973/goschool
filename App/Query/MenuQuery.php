<?php


namespace App\Query;


use Core\Database\QueryBuilder;

class MenuQuery
{
    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    /**
     * @return array $data
     */
    public function getMenusName()
    {
        $query = $this->builder->select('name')->from("menus");
        return $query->getResult();
    }

    /**
     * @return array $data
     */
    public function getMenuIdByName(string $name)
    {
        $query = $this->builder->select('id')->from("menus")->where("name = $name");
        return $query->getResult();
    }
}