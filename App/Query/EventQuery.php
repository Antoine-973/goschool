<?php
namespace App\Query;

use Core\Database\QueryBuilder;
use Core\Util\Helper;


class EventQuery
{
    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    public function getEvents(){
        $query = $this->builder->select('events.id, events.title, events.description, categories.name, events.status, users.fullname, start_date, end_date, events.created_at')->from("events")->join('INNER', 'events', 'categorie_id', 'categories', 'id')->join('INNER', 'events', 'user_id', 'users', 'id');
        return $query->getResult();
    }

    public function getEventsOrdered(){
        $query = $this->builder->select('events.id, events.title, events.description, categories.name, events.status, users.fullname, start_date, end_date, events.created_at')->from("events")->join('INNER', 'events', 'categorie_id', 'categories', 'id')->join('INNER', 'events', 'user_id', 'users', 'id')->orderBy('events.start_date','ASC')->limit(3);;
        return $query->getResult();
    }

    public function getEventById($id){
        $query = $this->builder->select('events.id, events.title, events.description, categories.name, events.status, users.fullname, start_date, end_date, events.created_at')->from("events")->join('INNER', 'events', 'categorie_id', 'categories', 'id')->join('INNER', 'events', 'user_id', 'users', 'id')->where("events.id = $id");
        return $query->getResult();
    }

    public function create(array $data)
    {
        $helper = new Helper();
        $data['slug']= $helper->slugify($data['title']);
        $data['title']= ucfirst(strtolower($data['title']));

        $query = $this->builder->insertInto('events')->columns($data)->values($data)->save();
        return $query;
    }

    public function delete($id)
    {
        $query = $this->builder->delete()->from('events')->where("id = $id")->save();
        return $query;
    }

    public function update($data, $id)
    {
        $helper = new Helper();
        $data['slug']= $helper->slugify($data['title']);
        $data['title']= ucfirst(strtolower($data['title']));

        $query = $this->builder->update('events')->set($data)->where("id = $id")->save();
        return $query;
    }

}