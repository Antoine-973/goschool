<?php

namespace Core;
use Core\Template\TemplateEngine;
use Core\Exception\Exception;

class Controller
{

    public function render($view, $data = []){

        $template = new TemplateEngine();
        echo $template->view($view, $data);
    }

    public function model($model){

        try {

            $file = dirname(__DIR__).DIRECTORY_SEPARATOR."Models".DIRECTORY_SEPARATOR.$model.".php";

            if(!\file_exists($file)){
                throw new  Exception("File not found: $file");
            }
        
            return new $model();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

}