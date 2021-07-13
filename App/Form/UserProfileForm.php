<?php
namespace App\Form;

use App\Query\UserQuery;
use Core\Http\Session;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;

class UserProfileForm
{

    private $session;
    private $userQuery;

    public function __construct(){
        $this->session = new Session();
        $this->userQuery = new UserQuery();
    }

    public function getForm()
    {
        $id = $this->session->getSession('id');
        $data=$this->userQuery->getUserById($id);

        $form = Form::create('/admin/user/updateProfile')
            ->input('firstname', 'text', ['value' => 'Prénom', 'min' => 3, 'max' => 55, 'text' => $data['firstname'], 'required' => 'required'])
            ->input('lastname', 'text', ['value' => 'Nom', 'min' => 3, 'max' => 55, 'text' => $data['lastname'], 'required' => 'required'])
            ->input('email', 'email', ['value' => 'Email', 'min' => 4, 'max' => 55, 'text' => $data['email'], 'required' => 'required'])
            ->input('password', 'password', ['value' => 'Mot de passe', 'min' => 8, 'max' => 55, 'required' => 'required'])
            ->input('passwordConfirm', 'password', ['value' => 'Confirmation du mot de passe', 'min' => 8, 'max' => 55, 'required' => 'required'])
            ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }


}