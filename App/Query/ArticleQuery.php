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
    public function getById($id)
    {
        $query = $this->builder->select("title, slug, content")->from("articles")->where("id = $id");
        return $query->getResult();
    }

    /**
     * @param int $id
     * @return string $query
     */
    public function getSlugById($id)
    {
        $query = $this->builder->select("slug")->from("articles")->where("id = $id");
        return $query->getResult();
    }

    /**
     * @return array $data
     */
    public function getArticleIdBySlug(string $slug)
    {
        $query = $this->builder->select('id')->from("articles")->where("slug = $slug");
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
        $query = $this->builder->select('articles.id, title, categories.name, users.email, status, articles.created_at')->from("articles")->join('INNER', 'articles', 'categorie_id', 'categories', 'id')->join('INNER', 'articles', 'user_id', 'users', 'id');
        return $query->getResult();
    }

    /**
     * @return array $data
     */
    public function getArticlesByUser($userId)
    {
        $query = $this->builder->select('articles.id, title, categories.name, users.email, status, articles.created_at')->from("articles")->join('INNER', 'articles', 'categorie_id', 'categories', 'id')->join('INNER', 'articles', 'user_id', 'users', 'id')->where("user_id = $userId");
        return $query->getResult();
    }

    /**
     * @return array $data
     */
    public function getAuthor($articleId)
    {
        $query = $this->builder->select('user_id')->from("articles")->where("id = $articleId");
        return $query->getResult();
    }

    /**
     * @return array $data
     */
    public function getArticlesSlug()
    {
        $query = $this->builder->select('slug')->from("articles");
        return $query->getResult();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $data['slug']= $this->helper->slugify($data['title']);
        $data['content']= str_replace('&#39;', '\'', str_replace( '&nbsp', '', html_entity_decode($data['content'])));
        $data['slug']= strtolower(str_replace(" ", "-", $data['title']));
        $data['title']= ucfirst(strtolower($data['title']));

        if(array_key_exists('active_comment', $data)){

            $data['active_comment'] = '1';

        }else{
            $data['active_comment'] = '0';
        }

        $query = $this->builder->insertInto('articles')->columns($data)->values($data)->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function updateArticle(array $data, $id)
    {
        $data['slug']= $this->helper->slugify($data['slug']);
        $data['content']= str_replace( '&nbsp', '', html_entity_decode($data['content']));
        $categorieQuery = new CategoryQuery();

        if (!$data['categorie']=='Non-classé'){
            $data['categorie_id'] = $categorieQuery->getCategoriesIdByName($data['categorie'])['id'];
        }

        unset($data['categorie']);

        if(array_key_exists('active_comment', $data)){

            $data['active_comment'] = '1';

        }else{
            $data['active_comment'] = '0';
        }

        if (array_key_exists('title', $data)){
            $data['title']= ucfirst(strtolower($data['title']));
        }

        $query = $this->builder->update("articles")->set($data)->where("id = $id")->save();
        return $query;
    }

    public function orderByDate()
    {
        $query = $this->builder->select('title, categorie_id, created_at')->from("articles")->orderBy('created_at','DESC');
        return $query->getResult();
    }
}