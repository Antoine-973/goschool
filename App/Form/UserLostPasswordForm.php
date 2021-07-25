<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserLostPasswordForm
{

    public function getForm()
    {
        $form = Form::create('/admin/auth/postLostPassword')
            ->input('email', 'email', ['value' => 'Email', 'min' => 4, 'max' => 55])
            ->input('submit', 'submit', ['value' => 'Réinitialiser le mot de passe']);
        return $form->getForm();
    }


}