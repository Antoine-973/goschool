<?php
namespace App\Form;

use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;

class CategoryEditForm
{

    private $request;

    public function __construct(){
        $this->request = new Request();
    }

    public function getForm()
    {
        $id = $this->request->getBody();

        $form = Form::create('/admin/user/edit')
            ->input('id', 'hidden', ['value' => $id['id']])
            ->input('name', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('slug', 'text', ['value' => 'Slug', 'min' => 4, 'max' => 55])
            ->select('parent_category','Parent Category',['id' => 'parent_category', 'name' => 'parent_category', 'options' => ['Uncategorized']])
            ->textarea('description', 'textarea', ['max' => 400])
            ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }
}