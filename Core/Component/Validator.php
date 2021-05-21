<?php
namespace Core\Component;
use Core\Database\Model;

class Validator
{
    private $errors = [];

    private $password;

    public function validate($model, $data){
        $properties = get_object_vars($model);
        $rules = $model->rules();

        foreach($data as $name => $value){
            if(property_exists($model, $name) && array_key_exists($name, $rules) && array_key_exists($name, $data)){
                $this->check($rules[$name], $data[$name], $name);
            }
        }

        return $this->errors;
        
    }

    protected function check(array $rules, $data, $name){

        foreach($rules as $key => $value){

            if($key == 'type' && $value == 'password'){
                $this->password = $data;
                $this->validatePassword($data, $name);
            }

            if($key == 'type' && $value == 'string'){
                $this->validateString($data, $name);
            }

            if($key == 'type' && $value == 'email'){
                $this->validateEmail($data, $name);
            }

            if($key == 'required' && $value == true){
                $this->validateRequired($data, $name);
            }

            if($key == 'min'){
                $this->validateMin($data, $value, $name);
            }
            if($key == 'max'){
                $this->validateMax($data, $value, $name);
            }

            if($key == 'match' && $value == 'password'){
                $this->validateMatch($data, $name);
            }
        }
    }

    protected function validateString($value, $name)
    {
        if(is_string($value)){
            return true;
        }
        $this->errors[] = "Invalid $name: must be a string";
    }

    protected function validateEmail($value, $name)
    {
         if(\filter_var($value, FILTER_VALIDATE_EMAIL)){
             return true;
         }

         $this->errors[] = "Invalid $name: must be an email address";
    }

    protected function validateRequired($value, $name)
    {
        if(!empty($value)){
            return true;
        }

        $this->errors[] = "Invalid $name: field is required";
    }

    protected function validateMin($value, $min, $name)
    {
        if(strlen($value) < $min){
            $this->errors[] = "Invalid $name: $min minimum characters";
        }
        return true;
    }

    protected function validateMax($value, $max, $name)
    {
        if(strlen($value) > $max){
            $this->errors[] = "Invalid $name: $max minimum characters";
        }

        return true;
    }

    public function validatePassword($value, $name)
    {
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

        if(preg_match($pattern, $value)){
            return true;
        }

        $this->errors[] = "Invalid $name must contains at least 8 characters, and with at least 1 number, 1 uppercase and 1 letter";
    }

    protected function validateMatch($value, $name)
    {
        if(strcmp($value, $this->password) == 0){
            return true;
        }

        $this->errors[] = "Invalid $name: must match password";
    }
}