<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserLostPasswordForm
{

    public function getForm()
    {
        $form = Form::create('/admin/lostpassword')
            ->input('email', 'email', ['value' => 'Email'])
            ->input('submit', 'submit', ['value' => 'Réinitialiser le mot de passe']);
        return $form->getForm();
    }


}