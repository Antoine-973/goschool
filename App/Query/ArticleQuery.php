<?php
namespace App\Query;

use Core\Database\QueryBuilder;

class ArticleQuery
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
        $query = $this->builder->select("*")->from("articles")->where("id = $id");
        return $query->getResult();
        return $query->getQuery();
    
    }

    /**
     * @param string $title
     */
    public function getByTitle(string $title)
    {
        $query = $this->builder->select("*")->from("articles")->where("title = $title");
        return $query->getResult();
    }
    
    /**
     * @param string $tag
     */
    public function getByTag(string $tag)
    {
        $query = $this->builder->select("*")->from("articles")->where("tag = $tag");
        return $query->getQuery();
    }

    /**
     * @param string $tag
     */
    public function orderByTag(string $tag)
    {
        $query = $this->builder->select("*")->from("articles")->orderBy("tag");
        return $query->getQuery();
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $query = $this->builder->delete()->from("articles")->where("id = $id");
    }


    /**
     * @return array $data
     */
    public function getArticles()
    {
        $query = $this->builder->select('*')->from("articles");
        return $query->getResult();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $query = $this->builder->insertInto('articles')->columns($data)->values($data)->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function updateArticles(array $data, int $id)
    {
        $query = $this->builder->update('articles')->set("")->where("id = $id");
    }
}