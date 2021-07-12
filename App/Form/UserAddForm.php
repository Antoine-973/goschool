<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserAddForm
{

    public function getForm()
    {

        $form = Form::create('/admin/user/store')
            ->input('firstname', 'text', ['value' => 'Prénom', 'min' => 3, 'max' => 55, 'required' => 'required'])
            ->input('lastname', 'text', ['value' => 'Nom', 'min' => 3, 'max' => 55, 'required' => 'required'])
            ->input('email', 'email', ['value' => 'Email', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('password', 'password', ['value' => 'Mot de passe', 'min' => 8, 'max' => 55, 'required' => 'required'])
            ->input('passwordConfirm', 'password', ['value' => 'Confirmation du mot de passe', 'min' => 8, 'max' => 55, 'required' => 'required'])
            ->select('roles','Role',['id' => 'roles', 'name' => 'roles', 'options' => ['admin','editeur','abonné','contributeur','auteur']])
            ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }


}