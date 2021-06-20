<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;
use Core\Http\Response;
use App\Form\UserLoginForm;
use App\Form\UserRegisterForm;
use App\Form\UserResetPasswordForm;
use App\Model\UserModel;
use Core\Component\Validator;
use App\Query\UserQuery;
use Core\Util\Hash;
use Core\Util\DotEnv;
class AdminAuthController extends Controller{

    private $request;

    private $response;

    private $userRegisterForm;

    private $userModel;

    private $validator;

    private $userQuery;

    private $session;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->userRegisterForm = new UserRegisterForm();
        $this->userModel = new UserModel();
        $this->validator = new Validator();
        $this->userQuery = new UserQuery();
        //$this->session = new Session();
    }

    public function indexLogin()
    {
        $form = new UserLoginForm();
        $userLogin = $form->getForm();

        $this->render("admin/user/login.phtml", ['userLogin'=>$userLogin]);
    }

    public function indexRegister()
    {

        $form = new UserRegisterForm();
        $userRegister = $form->getForm();

        $this->render("admin/user/register.phtml", ['userRegister'=>$userRegister]);
    }
    
    public function login()
    {
        $hash = new Hash();
        if($this->request->isPost()){

            $data = $this->request->getBody();
            $user = $this->userQuery->getByEmail($data['email']);

       

            if(!empty($data['email']) && !empty($data['password']) ){
         
                if(!empty($user) && $hash->compareHash($data['password'], $user['password_hash'])){
                        $this->request->redirect('/')->with('success', 'Connecté avec succès');
                }
            }else{

                $this->request->redirect('/admin/login')->with('fail', 'Invalid credentials');
            }

        }
    }

    public function register()
    {
        if($this->request->isPost()){

            $data = $this->request->getBody();
            
            ['db_user' => $db_user, 'db_password' => $db_password, 'db_name' => $db_name, 'db_host' => $db_host] = $this->request->getBody();
           
            $errors = $this->validator->validate($this->userModel, $data);

            if(empty($errors)){
                if($this->userQuery->create($data))
                {
                    $this->request->redirect('/admin/login')->with('success', 'Thanks for your registration.');
                }
                $this->request->redirect('/install')->with('errors', $errors);
            }else{
                $this->request->redirect('/install')->with('errors', $errors);
            }
        }
    }

    public function DBConnection($data)
    {/*
        (new DotEnv(dirname(dirname(dirname(__DIR__))) . '/.env'))->load();
        if($data['db_user'] && $data['db_name'] && $data['db_host']){
            putenv('DB_USER') = $data['db_user'];
            putenv('DB_NAME') = $data['db_name'];
            putenv('DB_HOTS') = $data['db_host'];
            putenv('DB_PASSWORD') = $data['db_password'];
        }
        */
    }
}