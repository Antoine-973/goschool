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
        $query = $this->builder->select('id, title, message, status, created_at')->from("comments");
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