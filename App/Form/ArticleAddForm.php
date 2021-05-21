<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class ArticleAddForm
{

    public function getForm()
    {

        $form = Form::create('/admin/article/add')
                ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
                ->textarea('content', 'textarea', ['required' => 'required', 'max' => 400])
                ->input('tag', 'text', ['value' => 'Tag'])
                ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }

   
}