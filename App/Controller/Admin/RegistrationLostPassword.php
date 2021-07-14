<?php
namespace App\Controller\Admin;

use App\Email\UserResetPasswordEmail;
use App\Form\UserResetPasswordForm;
use App\Model\LostPasswordModel;
use App\Model\UserModel;
use App\Query\LostPasswordQuery;
use Core\Component\Validator;
use Core\Controller;
use Core\Http\Request;
use App\Form\UserLostPasswordForm;
use Core\Http\Response;
use App\Query\UserQuery;
use Core\Util\Hash;
use Core\Util\TokenGenerator;
use Core\Util\Url;

class RegistrationLostPassword extends Controller
{


    public function __construct(){
        $this->request = new Request();
        $this->response = new Response();
        $this->userLostPasswordForm = new UserLostPasswordForm();
        $this->lostPasswordModel = new LostPasswordModel();
        $this->userModel = new UserModel();
        $this->validator = new Validator();
        $this->userQuery = new UserQuery();
        $this->lostPasswordQuery = new LostPasswordQuery();
        $this->token = new TokenGenerator();
        $this->hashToken = new Hash();
    }


}