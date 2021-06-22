<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class CommentAddForm
{

    public function getForm()
    {
        $form = Form::create('/admin/comment/add')
            ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->textarea('message', 'textarea', ['min' => 3, 'max' => 280, 'required' => 'required'])
            ->input('submit', 'submit', ['value' => 'Poster']);
        return $form->getForm();
    }

}