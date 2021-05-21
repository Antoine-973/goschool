<?php
namespace Core\Util;

class FormBuilder{

    private $form= [];

    public  function create(string $action, array $params = [])
    {
        $this->form[] =  "<form action=$action".
            ($params['method']) ? "method=". $params['method'] : 'POST' 
            . "enctype='multipart/form-data'"
            .($params['id']) ? "id=".$params['id']: ''
            .($params['name']) ? "name=" .$params['name']: ''
            .($params['class']) ? "class=" .$params['class']: '' . ">";
        
    }

    public function inputType(array $params)
    {
        $tag =  "<input type=" .$params['type']
                .isset($params['id'])? "id=" . $params['id']: ''
                ."name=" . $params['name']
                .$params['required']? $params['required']: ''
                .isset($params['minLength']) ? "minLength=". $params['minLength'] : ''
                .isset($params['maxLength']) ? "maxLength=". $params['maxLength'] : ''
                .isset($params['class']) ? "class=". $params['class'] : ''
                .isset($params['placeholder']) ? "placeholder=". $params['placeholder'] : ''
                .isset($params['value']) ? "value=". $params['value'] : ''
                . "/>";
        echo $tag;die;
        $this->form[] = $tag;
    }


    public function selectType(array $params)
    {
 
        $tag = "<select" . ($params['id']) ? "id=". $params['id']: ''
            ."name=".$params['name'] . ">". implode('', $this->getOptions($params['options'])) . "</select>";
        $this->form[] = $tag;
        
    }


    public function labelType($params)
    {
        $tag = "<label". ($params['for']) ? "for=" . $params['for'] : '' .">". $params['text'] . "</label>";
        $this->form[] = $tag;
    }

    protected function getOptions(array $options)
    {
        $optionArray = [];

         function formatOption($option){
            return  "<option value=". $option['value'] . ($options['selected'])? "selected" : '' . ">" . $option['text'] . "</option>";
        }

        foreach($options as $option){
            $optionArray[] = array_map('formatOption', $option);
        }
    }

    public function getForm()
    {   
        $this->form[] = '</form>';

        var_dump($this->form);
    }
}