<?php
namespace App\Form;
use Core\Facade\Form;

class UserRegisterForm 
{

    public function getForm()
    {

        $form = Form::create('/admin/register')
                ->input('firstname', 'text', ['value' => 'Prénom', 'min' => 4, 'max' => 55, 'required' => 'required'])
                ->input('lastname', 'text', ['value' => 'Nom'])
                ->input('email', 'email', ['value' => 'Addresse E-mail', 'min' => 4, 'max' => 55])
                ->input('password', 'password', ['value' => 'Mot de passe', 'max' => 30])
                ->input('passwordConfirm', 'password', ['value' => 'Confirmer mot de passe', 'max' => 30])
                ->input('register', 'submit', ['value' => 'Inscription']);
                
        return $form->getForm();
    }

}