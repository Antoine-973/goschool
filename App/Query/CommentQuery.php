<?php
namespace App\Query;

use Core\Database\QueryBuilder;

class CommentQuery{

    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();

    }

    /**
     * @return array $data
     */
    public function getComments()
    {
        $query = $this->builder->select('id, title, message, status, created_at, user_id')->from("comments");
        return $query->getResult();
    }

    /**
     * @param int $id
     * @return string $query
     */
    public function getById(int $id)
    {
        $query = $this->builder->select("title, message, status")->from("comments")->where("id = $id");
        return $query->getResult();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $articleQuery = new ArticleQuery();
        $data['article_id'] = $articleQuery->getArticleIdBySlug($data['article'])['id'];
        unset($data['article']);

        $userQuery = new UserQuery();
        $data['user_id'] = $userQuery->getIdByEmail($data['user'])['id'];
        unset($data['user']);

        $query = $this->builder->insertInto('comments')->columns($data)->values($data)->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function updateComment(array $data, int $id)
    {
        $query = $this->builder->update("comments")->set($data)->where("id = $id")->save();
        return $query;
    }

    /**
     * @param int $id
     */
    public function deleteComment(int $id)
    {
        $query = $this->builder->delete()->from('comments')->where("id = $id")->save();
        return $query;
    }

}