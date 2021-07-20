<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class CommentChangeForm
{

    public function getForm()
    {
         $form = Form::create('/admin/comment/update/'.$stringId)
            ->textarea('message', 'textarea', ['min' => 3, 'max' => 280, 'required' => 'required'])
            ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }

}