<?php
namespace App\Query;

use Core\Database\QueryBuilder;

class PageQuery
{
    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();

    }

    /**
     * @param int $id
     * @return string $query
     */
    public function getById(int $id)
    {
        $query = $this->builder->select("*")->from("pages")->where("id = $id");
        return $query->getQuery();
    
    }

    /**
     * @param string $title
     */
    public function getByTitle(string $title)
    {
        $query = $this->builder->select("*")->from("pages")->where("title = $title");
        return $query->getQuery();
    }
    
    /**
     * @param string $tag
     */
    public function getByTag(string $tag)
    {
        $query = $this->builder->select("*")->from("pages")->where("tag = $tag");
        return $query->getQuery();
    }

    /**
     * @param string $tag
     */
    public function orderByTag(string $tag)
    {
        $query = $this->builder->select("*")->from("pages")->orderBy("tag", "ASC");
        return $query->getQuery();
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $query = $this->builder->delete()->from("pages")->where("id = $id");
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $query = $this->builder->insert('pages')->value($data);
    }

    /**
     * @param array $data
     */
    public function updatePage(array $data, int $id)
    {
        $query = $this->builder->update('pages')->set("data = $data")->where("id = $id");
    }
}