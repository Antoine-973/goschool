<?php
namespace App\Form;

use App\Query\UserQuery;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;

class UserEditForm
{

    private $request;

    public function __construct(){
        $this->request = new Request();
        $this->userQuery = new UserQuery();
    }

    public function getForm()
    {
        $id = $this->request->getBody();
        $stringId = implode("','",$id);

        $data = $this->userQuery->getUserById($stringId);

        $form = Form::create('/admin/user/edit')
            ->input('id', 'hidden', ['value' => $id['id']])
            ->input('firstname', 'text', ['value' => 'Prénom', 'text' => $data['firstname'], 'min' => 3, 'max' => 55, 'required' => 'required'])
            ->input('lastname', 'text', ['value' => 'Nom', 'text' => $data['lastname'], 'min' => 3, 'max' => 55, 'required' => 'required'])
            ->input('email', 'email', ['value' => 'Email', 'text' => $data['email'], 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('password', 'password', ['value' => 'Mot de passe', 'min' => 8, 'max' => 55, 'required' => 'required'])
            ->input('passwordConfirm', 'password', ['value' => 'Confirmation du mot de passe', 'min' => 8, 'max' => 55, 'required' => 'required'])
            ->select('roles','Role',['id' => 'roles', 'name' => 'roles', 'text' => $data['roles'], 'options' => ['admin','editeur','abonné','contributeur','auteur']])
            ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }


}