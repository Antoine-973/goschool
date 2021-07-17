<?php
namespace App\Query;

use Core\Database\QueryBuilder;

class ParamQuery{

    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();

    }

    /**
     * @return array $data
     */
    public function getParam()
    {
        $query = $this->builder->select('id, site_name, url, visible, default_role, name_role, description, lang, save, update, created_at')->from("parameters");
        return $query->getResult();
    }

    public function getSiteName()
    {
        $query = $this->builder->select('site_name')->from("parameters");
        return $query->getResult();
    }

    /**
     * @param array $data
     */
    public function updateParam(array $data, int $id)
    {
        $query = $this->builder->update("parameters")->set($data)->where("id = $id")->save();
        return $query;
    }

}