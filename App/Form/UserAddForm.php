<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserAddForm
{

    public function getForm()
    {

        $form = Form::create('/admin/users/add')
            ->input('firstname', 'text', ['value' => 'Firstname', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('lastname', 'text', ['value' => 'Lastname', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('email', 'email', ['value' => 'Email', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('password', 'password', ['value' => 'Password', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('role', 'text', ['value' => 'Role', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('submit', 'submit', ['value' => 'Ajouter Nouvel Utilisateur']);
        return $form->getForm();
    }


}