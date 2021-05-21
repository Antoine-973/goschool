<?php
namespace Core\Database;
use Core\Database\DB;
use Core\Util\Hash;
class QueryBuilder{

    private $fields;

    private $condition;

    private $from;

    private $table;

    private $query;

    private $column;

    private $values;

    private $data = [];

    public function select(): QueryBuilder
    {
        $this->fields = \func_get_args();
        $this->query .= 'SELECT ' . implode(', ', $this->fields);
        return $this;
    }

    public function where(): QueryBuilder
    {
        foreach(\func_get_args() as $arg){
            $arr = explode(' = ', $arg);
            $field = $arr[0];
            $value = $arr[1];
            $this->condition[] = $field . " = " . "'$value'";
        }
    
        $this->query .= ' WHERE ' . implode(', AND', $this->condition) . ";";
        return $this;
    }

    public function from($table, $alias = null): QueryBuilder
    {
        if(is_null($alias)){
            $this->from[] = $table;
        }else{
            $this->from[] = "$table AS $alias";
        }
        $this->query .= ' FROM ' . implode(', ', $this->from);
        return $this;
    }

    public function join(): QueryBuilder
    {
        return $this;
    }


    /**
     * @return string $query
     */
    public function getQuery() : string
    {
        return $this->query;
    }

    public function getResult()
    {
      
        try{
            $db = new DB();
            $pdo = $db::getConnection();

            $stmt = $pdo->prepare($this->query);
            $stmt->execute();
            return $stmt->fetch(DB::FETCH_ASSOC);
        }catch(\PDOException $e){
            echo $e->getMessage();
        }
    }

    public function save()
    {
        try{
            $db = new DB();
            $pdo = $db::getConnection();
            $values = array_values($this->data);
            
            $stmt= $pdo->prepare($this->query);
            $stmt->execute($values);
        }catch(\PDOException $e){
            echo $e->getMessage();
        }
        return $this->data;
    }


    public function update($table, $alias = null): QueryBuilder
    {
        if(is_null($alias)){
            $this->table = $table;
        }else{
            $this->table = "$table AS $alias";
        }
        $this->query .= ' UPDATE ' . $this->table;
        
        return $this;
    }

    public function set(array $data)
    {
        $this->fields = \func_get_args();
        $rowStr = "";
        $lastElement = end($data);
        foreach($data as $row => $value){
            if($row == 'id'){
                continue;
            }
            elseif ($value == $lastElement)
            {
                $rowStr .= $row . ' = ' . "'$value' ";
            }
            else{
                $rowStr .= $row . ' = ' . "'$value', ";
            }
        }

        $this->query .= ' SET ' . $rowStr;
        return $this;
    }

    public function delete(): QueryBuilder
    {
        $this->fields = \func_get_args();
        $this->query .= 'DELETE ';
        return $this;
    }

    public function insertInto($tableName)
    {
        $this->table = $tableName;
        $this->query .= 'INSERT INTO ' . $this->table;
        return $this;
    }

    public function columns(array $data)
    {
       
        $timestamp = date('Y-m-d H:i:s');

        $data['created_at'] = $timestamp;
        $data['updated_at'] = $timestamp;


        foreach($data as $key => $value){
            $this->data[$key] = $value;
        }

        $columns = array_keys($this->data);
    
        $columnsStr = "";
        $last = array_pop($columns);

        foreach($columns as $col){
            $columnsStr .= $col .", ";
        }
        $columnsStr .= $last .") ";

        $columnsStr = " (" . $columnsStr;
        $this->query .= $columnsStr;
        return $this;
    }


    public function values(array $data)
    {
        $values = array_values($this->data);
   
        $in = str_repeat('?,', count($values) - 1) . '?';

        $this->query .= " VALUES (" . $in . ");";
        return $this;

    }

}