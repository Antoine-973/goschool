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
}