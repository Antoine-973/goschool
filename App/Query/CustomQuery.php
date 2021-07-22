<?php
namespace App\Query;

use Core\Database\QueryBuilder;

class CustomQuery{

    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    /**
     * @return array $data
     */
    public function getCustom()
    {
        $query = $this->builder->select('*')->from("customs");
        return $query->getResult();
    }
}