<?php
namespace Core\Database;
use Core\Database\DB;
abstract class Model {
    public const RULE_REQUIRED = 'required';

    private $rules;

    private $properties;
    
    abstract function rules();

    public function save($query)
    {   
        $properties = get_object_vars($this);
        
        $db = DB::getConnection();
    }

    public function validate($data)
    {
        foreach($data as $key => $value){
            if(\property_exists($this, $key)){
                $model->{$key} = $value;
            }
        }
    }

    public function errorMessages()
    {

    }


}