<?php
namespace Core\Database;

class QueryBuilder{

    private $fields;

    private $condition;

    private $from;

    public function select(): QueryBuilder
    {
        $this->fields = \func_get_args();
        return $this;
    }

    public function where(): QueryBuilder
    {
        foreach(\func_get_args() as $arg){
            $this->condition[] = $arg;
        }
        return $this;
    }

    public function from($table, $alias = null): QueryBuilder
    {
        if(is_null($alias)){
            $this->from[] = $table;
        }else{
            $this->from[] = "$table AS $alias";
        }

        return $this;
    }


    public function getQuery() : string
    {

        return 'SELECT ' . implode(', ', $this->fields) 
                .' FROM ' . implode(', ', $this->from)
                .' WHERE ' . implode(', AND', $this->condition);
    }

}