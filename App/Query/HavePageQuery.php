<?php
namespace App\Query;

use Core\Database\QueryBuilder;

class HavePageQuery{

    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    public function getById($menu_id, $page_id){
        $query = $this->builder->select('*')->from('havePage')->where("menu_id = $menu_id","page_id = $page_id");
        return $query->getResult();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $query = $this->builder->insertInto('havePage')->columns($data)->values($data)->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function update(array $data, $menu_id, $page_id)
    {
        $query = $this->builder->update("havePage")->set($data)->where("menu_id = $menu_id, page_id = $page_id")->save();
        return $query;
    }

    /**
     * @param int $id
     */
    public function delete($menu_id, $page_id)
    {
        $query = $this->builder->delete()->from('havePage')->where("menu_id = $menu_id", "page_id = $page_id")->save();
        return $query;
    }
}
