<?php
namespace Core\Facade;
use Core\Component\FormBuilder;

class Form {

    public static function __callStatic($method, $arguments)
    {
        $builder = new FormBuilder();
        return \call_user_func_array([$builder, $method], $arguments);
    }
}