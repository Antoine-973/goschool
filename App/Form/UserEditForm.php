<?php
namespace App\Form;

use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;

class UserEditForm
{

    private $request;

    public function __construct(){
        $this->request = new Request();
    }

    public function getForm()
    {
        $id = $this->request->getBody();

        $form = Form::create('/admin/users/edit')
            ->input('id', 'hidden', ['value' => $id['id']])
            ->input('firstname', 'text', ['value' => 'Prénom', 'min' => 3, 'max' => 55, 'required' => 'required'])
            ->input('lastname', 'text', ['value' => 'Nom', 'min' => 3, 'max' => 55, 'required' => 'required'])
            ->input('email', 'email', ['value' => 'Email', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('password', 'password', ['value' => 'Mot de passe', 'min' => 8, 'max' => 55, 'required' => 'required'])
            ->input('passwordConfirm', 'password', ['value' => 'Confirmation du mot de passe', 'min' => 8, 'max' => 55, 'required' => 'required'])
            ->select('roles','Role',['id' => 'roles', 'name' => 'roles', 'options' => ['admin','editeur','abonné','contributeur','auteur']])
            ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }


}