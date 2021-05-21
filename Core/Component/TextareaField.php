<?php
namespace Core\Component;
class TextareaField{

    public function getField($name, $label, $params)
    {

        $placeholder = $params['placeholder'] ?? '...';
        $min = $params['min'] ?? 3;
        $max = $params['max'] ?? 25;
        $cols = $params['cols'] ?? 33;
        $rows = $params['rows'] ?? 5;
        $required = $params['required'] ?? '';

        return sprintf(
            "<div class=\"input-group\">
                <label for=%s>%s</label>
                <textarea name=%s id=%s rows=%s cols=%s placeholder=%s minlength=%s maxlength=%s $required></textarea>
            </div>
            ",
            $name,
            ucfirst($label),
            $name,
            $name,
            $rows,
            $cols,
            $placeholder,
            $min,
            $max
  
        );
    }


}