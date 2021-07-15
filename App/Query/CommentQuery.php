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
        $query = $this->builder->select('comments.id, message, comments.status, users.email, articles.title, comments.created_at')->from("comments")->join('INNER', 'comments', 'article_id', 'articles', 'id')->join('INNER', 'comments', 'user_id', 'users', 'id');
        return $query->getResult();
    }

    public function getCommentsByArticleId(int $id)
    {
        $query = $this->builder->select('id, title, message, created_at, user_id, status')->from("comments")->where("article_id = $id");
        return $query->getResult();
    }

    /**
     * @param int $id
     * @return string $query
     */
    public function getById(int $id)
    {
        $query = $this->builder->select("message, status")->from("comments")->where("id = $id");
        return $query->getResult();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
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