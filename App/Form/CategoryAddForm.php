<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class CategoryAddForm
{

    public function getForm()
    {

        $form = Form::create('/admin/article/add')
            ->input('name', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('slug', 'text', ['value' => 'Slug', 'min' => 4, 'max' => 55])
            ->select('parent_category','Parent Category',['id' => 'parent_category', 'name' => 'parent_category', 'options' => ['Uncategorized']])
            ->textarea('description', 'textarea', ['max' => 400])
            ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }

}