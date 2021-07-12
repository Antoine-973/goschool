<?php
namespace App\Query;

use Core\Database\QueryBuilder;
use Core\Util\Helper;

class ArticleQuery
{
    private $builder;

    private $helper;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
        $this->helper = new Helper();
    }

    /**
     * @param int $id
     * @return string $query
     */
    public function getById(int $id)
    {
        $query = $this->builder->select("title, slug, content")->from("articles")->where("id = $id");
        return $query->getResult();
    }

    /**
     * @param int $id
     * @return string $query
     */
    public function getSlugById(int $id)
    {
        $query = $this->builder->select("slug")->from("articles")->where("id = $id");
        return $query->getResult();
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
    public function deleteArticle(int $id)
    {
        $query = $this->builder->delete()->from('articles')->where("id = $id")->save();
        return $query;
    }


    /**
     * @return array $data
     */
    public function getArticles()
    {
        $query = $this->builder->select('id, title, status, updated_at')->from("articles");
        return $query->getResult();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $data['slug']= $this->helper->slugify($data['title']);
        $data['content']= str_replace( '&nbsp', '', html_entity_decode($data['content']));
        
        if(array_key_exists('active_comment', $data)){

            $data['active_comment'] = 1;

        }else{
            $data['active_comment'] = 0;
        }

        $query = $this->builder->insertInto('articles')->columns($data)->values($data)->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function updateArticle(array $data, int $id)
    {
        $data['slug']= $this->helper->slugify($data['title']);
        $data['content']= str_replace( '&nbsp', '', html_entity_decode($data['content']));
        $categorieQuery = new CategoryQuery();
        $data['categorie_id'] = $categorieQuery->getCategoriesIdByName($data['categorie'])['id'];
        unset($data['categorie']);

        if(array_key_exists('active_comment', $data)){

            $data['active_comment'] = 1;

        }else{
            $data['active_comment'] = 0;
        }

        $query = $this->builder->update("articles")->set($data)->where("id = $id")->save();
        return $query;
    }

    public function orderByDate()
    {
        $query = $this->builder->select('title, created_at')->from("articles")->orderBy('created_at','DESC');
        return $query->getResult();
    }
}