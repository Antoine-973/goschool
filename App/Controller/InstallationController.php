<?php
namespace App\Controller;
use Core\Controller;
use Core\Util\DotEnv;
use Core\Http\Redirect;
use Core\Http\Request;
use App\Form\UserRegisterForm;

class InstallationController extends Controller
{

    public function index()
    {
        $userForm = new UserRegisterForm();

        $this->view("install.phtml", ['userForm' => $userForm]);
    }
}