<?php
namespace Core\Util;
use Core\Util\FormType;

class Form extends FormType{
    
    private $form = [];

    public  function start(string $action, array $params = [])
    {
        $this->form[] =  "<form action=$action".
            ($params['method']) ? "method=". $params['method'] : 'POST' 
            . "enctype='multipart/form-data'"
            .($params['id']) ? "id=".$params['id']: ''
            .($params['name']) ? "name=" .$params['name']: ''
            .($params['class']) ? "class=" .$params['class']: '' . ">";
        
        return $this;
    }

    public function input(array $params)
    {
        $this->form[] = $this->inputType($params);
        return $this;
    }

    public function select(array $params)
    {
        $this->form[] = $this->selectType($params);
        return $this;
    }

    public function label(array $params)
    {
        $this->form[] = $this->labelType($params);
        return $this;
    }

    public function textArea(array $params)
    {
        $this->form[] = $this->textareaType($params);
        return $this;
    }

    public function getForm()
    {
        $this->form[] = "</form>";

        return $this->form;
    }
}