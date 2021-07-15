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
    public function getMenu($id)
    {
        $query = $this->builder->select("name, description")->from("menus")->where("id = $id");
        return $query->getResult();
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

    public function getPositionByPosition($position)
    {
        $query = $this->builder->select('id')->from("menus")->where("position = $position");
        return $query->getResult();
    }

    public function updatePositionToNull($data, $position)
    {
        $query = $this->builder->update('menus')->set($data)->where("position = $position")->save();
        return $query;
    }



    /**
     * @param int $id
     */
    public function delete($id)
    {
        $query = $this->builder->delete()->from("menus")->where("id = $id")->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $query = $this->builder->insertInto('menus')->columns($data)->values($data)->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function update($data, $id)
    {
        $query = $this->builder->update('menus')->set($data)->where("id = $id")->save();
        return $query;
    }
}