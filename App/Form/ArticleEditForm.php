<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class ArticleEditForm
{

    public function getForm()
    {

        $form = Form::create('/admin/article/edit')
                ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
                ->textarea('content', 'textarea', ['required' => 'required', 'max' => 400])
                // ->input('tag', 'text', ['value' => 'Tag'])
                ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }

   
}