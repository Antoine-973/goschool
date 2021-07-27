<?php
namespace Core\Component;
use Core\Database\Model;

class Validator
{
    private $errors = [];

    private $password;

    private $url;

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

            if($key == 'id' && $value == 'title'){
                $this->url = $data;
                $this->validateTitle($data, $name);
            }

            if($key == 'id' && $value == 'name'){
                $this->url = $data;
                $this->validateName($data, $name);
            }

            if($key == 'id' && $value == 'url'){
                $this->url = $data;
                $this->validateUrl($data, $name);
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
        $this->errors[] = "Champs $name invalide: doit être une chaine de caractère";
    }

    protected function validateEmail($value, $name)
    {
         if(\filter_var($value, FILTER_VALIDATE_EMAIL)){
             return true;
         }

         $this->errors[] = "Champs $name invalide: doit être une adresse email";
    }

    protected function validateRequired($value, $name)
    {
        if(!empty($value)){
            return true;
        }

        $this->errors[] = "Champs $name: ce champs est obligatoire";
    }

    protected function validateMin($value, $min, $name)
    {
        if(strlen($value) < $min){
            $this->errors[] = "Champs $name invalide: Le nombre de caractère minimum est : $min";
        }
        return true;
    }

    protected function validateMax($value, $max, $name)
    {
        if(strlen($value) > $max){
            $this->errors[] = "Champs $name invalide: Le nombre de caractère minimum est : $max";
        }

        return true;
    }

    public function validatePassword($value, $name)
    {
        $pattern = "/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!#@$%^&(){}[\]:;<>,.?\/~_+\-=|]).*$/";

        if(preg_match($pattern, $value)){
            return true;
        }

        $this->errors[] = "Champs $name invalide : doit contenir au moins 8 caractères, avec au moins 1 chiffre, 1 caractère spécial, une lettre en majuscule et une lettre minuscule";
    }

    public function validateUrl($value, $name)
    {
        $pattern = "/^\/[a-z]*$|^\/[a-z]*[-[a-z]*$/";

        if(preg_match($pattern, $value)){
            return true;
        }

        $this->errors[] = "Champs $name invalide : doit contenir au minimum un slash (accueil) et au maximum un slash suivi d'un mot. Doit seulement contenir des lettres minuscules.";
    }

    public function validateTitle($value, $name)
    {
        $pattern = "/^[\w\-\s:?,;.!()&'\"]*$/um";

        if(preg_match($pattern, $value)){
            return true;
        }

        $this->errors[] = "Champs $name invalide : doit contenir au moins 4 caractères, avec seulement des chiffres, des lettres et des espaces ainsi que les caractères spéciaux de ponctuation.";
    }

    public function validateName($value, $name)
    {

        if(ctype_alnum((str_replace(' ','', $value)))){
            return true;
        }

        $this->errors[] = "Champs $name invalide : doit contenir au moins 4 caractères, avec seulement des chiffres, des lettres et des espaces";
    }

    protected function validateMatch($value, $name)
    {
        if(strcmp($value, $this->password) == 0){
            return true;
        }

        $this->errors[] = "Champs $name invalide: la valeur doit matcher avec celle du mot de passe";
    }
}