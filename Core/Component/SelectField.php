<?php
namespace Core\Component;

class SelectField{

    public function getField($name, $label, $params)
    {
        $options = $this->getOptions($params['options']);
        $required = $params['required'] ?? '';
        
        return sprintf(
            "<div class=\"input-group\">
                <label for=%s>%s</label>
                <select name=%s id=%s $required />
                    %s
                </select>
            </div>
            ",
            $name,
            ucfirst($label),
            $name,
            $name,
            $options
        );
    }

    protected function getOptions($params)
    {
        $opt = [];

        foreach($params as $value){
            $opt[] = "<option value=$value>". ucfirst($value). "</option>";
        }

        return implode('', $opt);
    }

}