<?php
namespace App\Form;

use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;

class UserResetPasswordForm
{
    private $request;

    public function __construct(){
        $this->request = new Request();
    }

    public function getForm()
    {
        $data = $this->request->getBody();

        $form = Form::create('/admin/resetpassword')
                ->input('selector', 'hidden', ['value' => $data['selector']])
                ->input('validator', 'hidden', ['value' => $data['validator']])
                ->input('password', 'password', ['value' => 'Nouveau mot de passe'])
                ->input('passwordConfirm', 'password', ['value' => 'Confirmer le mot de passe'])
                ->input('submit', 'submit', ['value' => 'Changer']);
        return $form->getForm();
    }

   
}