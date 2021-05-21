<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserLoginForm
{

    public function getForm()
    {

        $form = Form::create('/admin/login')
                ->input('email', 'email', ['value' => 'Email'])
                ->input('password', 'password', ['value' => 'Mot de passe'])
                ->input('submit', 'submit', ['value' => 'Connexion']);
        return $form->getForm();
    }

   
}