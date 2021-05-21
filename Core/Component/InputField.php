<?php
namespace Core\Component;
use Core\Interfaces\FormFieldInterface;
use Core\Component\Validator;

class InputField{

    public function getField($name, $type, $params)
    {

        $validator = new Validator();

        $placeholder = $params['placeholder'] ?? $name;
        $value = $params['value'] ?? $name;
        $min = $params['min'] ?? 3;
        $max = $params['max'] ?? 25;
        $required = $params['required'] ?? '';
        $checked = $params['checked'] ?? '';

        if($type == 'text' || $type == 'email' || $type == 'password'){

            return sprintf(
                "<div class=\"input-group\">
                    <label for=%s>%s</label>
                    <input type=%s name=%s id=%s placeholder=%s minlength=%s maxlength=%s $required />
                    <div class=\"text-error\"></div>
                </div>
                ",
                $name,
                ucfirst($value),
                $type,
                $name,
                $name,
                $placeholder,
                $min,
                $max
            );
        }

        if($type == 'submit' ){

            return sprintf(
                "<div class=\"input-group\">
                    <input type=%s id=%s  value=%s />
                </div>
                ",
                $type,
                $name,
                $value
            );
        }

        if($type == 'radio'){

            return sprintf(
                "<div class=\"input-group\">
                    <label for=%s>%s</label>
                    <input type=%s name=%s id=%s $required value=%s $checked />
                </div>
                ",
                $name,
                ucfirst($value),
                $type,
                $name,
                $value,
                $value
            );
        }

        if($type == 'checkbox'){
            
        return sprintf(
            "<div class=\"input-group\">
                <label for=%s>%s</label>
                <input type=%s name=%s id=%s $required />
            </div>
            ",
            $name,
            ucfirst($value),
            $type,
            $name,
            $value
        );
        }

        if($type == 'submit'){
            return sprintf(
                "<div class=\"input-group\">
                    <input type=%s name=%s id=%s value=%s />
                </div>
                ",
                $type,
                $name,
                $name,
                ucfirst($value),
            );   
        }

        
        if($type == 'hidden'){
            return sprintf(
                "<input type=%s name=%s id=%s value=%s />
                ",
                $type,
                $name,
                $name,
                $value
            );   
        }
    }


}