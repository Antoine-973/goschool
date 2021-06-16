<?php
namespace App\Query;

use Core\Database\QueryBuilder;

class CategoryQuery{

    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();

    }

    /**
     * @return array $data
     */
    public function getCategories()
    {
        $query = $this->builder->select('id, name, slug, description')->from("categories");
        return $query->getResult();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $query = $this->builder->insertInto('categories')->columns($data)->values($data)->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function updateCategory(array $data, int $id)
    {
        $query = $this->builder->update("categories")->set($data)->where("id = $id")->save();
        return $query;
    }

    /**
     * @param int $id
     */
    public function deleteCategory(int $id)
    {
        $query = $this->builder->delete()->from('categories')->where("id = $id")->save();
        return $query;
    }
}