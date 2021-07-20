<?php
namespace App\Form;
use App\Query\RoleQuery;
use Core\Facade\Form;
use Core\Util\Table;


class UserAddForm
{

    public function __construct(){
        $this->roleQuery = new RoleQuery();
    }

    public function getForm()
    {
        $convertTable = new Table();
        $roles = $convertTable->multi_to_single($this->roleQuery->getRoles());
        unset($roles['0']);

        $form = Form::create('/admin/user/store')
            ->input('firstname', 'text', ['value' => 'Prénom', 'min' => 3, 'max' => 55, 'required' => 'required'])
            ->input('lastname', 'text', ['value' => 'Nom', 'min' => 3, 'max' => 55, 'required' => 'required'])
            ->input('email', 'email', ['value' => 'Email', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('password', 'password', ['value' => 'Mot de passe', 'min' => 8, 'max' => 55, 'required' => 'required'])
            ->input('passwordConfirm', 'password', ['value' => 'Confirmation du mot de passe', 'min' => 8, 'max' => 55, 'required' => 'required'])
            ->select('role','Role',['id' => 'role', 'name' => 'role', 'options' => $roles])
            ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }


}