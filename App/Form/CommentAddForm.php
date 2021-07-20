<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class CommentAddForm
{

    public function getForm()
    {
         $form = Form::create('/admin/comment/store')
            ->textarea('message', 'textarea', ['min' => 3, 'max' => 280, 'required' => 'required'])
            ->input('submit', 'submit', ['value' => 'Poster']);
        return $form->getForm();
    }

}