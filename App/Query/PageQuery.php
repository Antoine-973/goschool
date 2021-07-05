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
     * @return string $query
     */
    public function getPages()
    {
        $query = $this->builder->select("id, title, status, updated_at")->from("pages");

        return $query->getResult();
    }

    /**
     * @param int $id
     * @return string $query
     */
    public function getById(int $id)
    {
        $query = $this->builder->select("title, content")->from("pages")->where("id = $id");
        return $query->getResult();
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
        $query = $this->builder->delete()->from("pages")->where("id = $id")->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $data['content']= html_entity_decode($data['content']);

        $query = $this->builder->insertInto('pages')->columns($data)->values($data)->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function updatePage(array $data, int $id)
    {
        $query = $this->builder->update('pages')->set($data)->where("id = $id")->save();
    }
}