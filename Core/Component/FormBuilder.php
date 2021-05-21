<?php
namespace Core\Component;

use Core\ORM\Model;
use Core\Component\InputField;
use Core\Component\SelectField;
use Core\Component\TextareaField;

class FormBuilder
{
    private $form = [];

    /**
     * @param string $action
     * @param string $method
     * @return FormBuilder
     */
    public function create($action, $method="POST", $enctype="multipart/form-data"): FormBuilder
    {
        $this->form[] = "<form action=$action method=$method enctype=$enctype>";
        return $this;
    }

    /**
     * @param string $name
     * @param object $type
     * @param string $label
     * @return FormBuilder
     */
    public function input($name, $type, $params = []): FormBuilder
    {
        $input = new InputField();
        $this->form[] = $input->getField($name, $type, $params);
        return $this;
    }

    public function select($name, $label, $params = [])
    {
        $select = new SelectField();
        $this->form[] = $select->getField($name, $label, $params);
        return $this;
    }

    public function textarea($name, $label, $params = [])
    {
        $textarea = new TextareaField();
        $this->form[] = $textarea->getField($name, $label, $params);
        return $this;
    }

    /**
     * @return array $this->form
     */
    public function getForm()
    {
        $this->form[] = "</form>";
        return implode('', $this->form);
    }
}