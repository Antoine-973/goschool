<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserLoginForm
{

    public function getForm()
    {

        $form = Form::create('/admin/auth/postLogin')
                ->input('email', 'email', ['value' => 'Email', 'min' => 4, 'max' => 55])
                ->input('password', 'password', ['value' => 'Mot de passe', 'max' => 55])
                ->input('submit', 'submit', ['value' => 'Connexion']);
        return $form->getForm();
    }

   
}