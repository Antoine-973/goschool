<?php
namespace App\Controller;
use Core\Controller;
use App\Query\UserQuery;
use App\Form\UserRegisterForm;

class HomeController extends Controller{

    public function index(){

        $userform = new UserRegisterForm();
        $form = $userform->getForm();
        $userQuery = new UserQuery();

        $data = [
            'firstname' => 'Christian',
            'lastname' => 'Mohindo',
            'email' => 'email@test.com',
            'password' => 'mdrmamam',
            'passwordConfirm' => 'mdrmamam',
        ];


        $query = $userQuery->getById(1);

        return $this->render('welcome.phtml', ['registerForm' => $form, 'query' => $query]);

    }
}