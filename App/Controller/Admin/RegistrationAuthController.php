<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;
use Core\Http\Response;
use App\Form\UserLoginForm;
use App\Form\UserRegisterForm;
use App\Model\UserModel;
use Core\Component\Validator;
use App\Query\UserQuery;
use Core\Util\Hash;
use App\Email\UserRegisterValidationEmail;
use Core\Util\Url;

class RegistrationAuthController extends Controller{

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
        $this->session = new Session();
    }

    public function indexLogin()
    {
        $form = new UserLoginForm();
        $userLogin = $form->getForm();

        $this->render("admin/registration/login.phtml", ['userLogin'=>$userLogin]);
    }

    public function indexRegister()
    {

        $form = new UserRegisterForm();
        $userRegister = $form->getForm();

        $this->render("admin/registration/register.phtml", ['userRegister'=>$userRegister]);
    }
    
    public function login()
    {
        $hash = new Hash();
        if($this->request->isPost()){

            $data = $this->request->getBody();
            $user = $this->userQuery->getByEmail($data['email']);

            if(!empty($data['email']) && !empty($data['password']) ){
         
                if(!empty($user)){
                    if($hash->compareHash($data['password'], $user['password_hash'])){

                        if ($user['verified'] == '1'){

                            $selectIdQuery = new UserQuery();
                            $idUser = $selectIdQuery->getIdbyEmail($data['email']);
                            $this->session->setSession('id',$idUser['id']);
                            $this->request->redirect('/admin')->with('error', 'Connect?? avec succ??s');
                        }
                        else{
                            $this->request->redirect('/admin/login')->with('error', 'Ce compte n\'a pas encore ??t?? valid??. Veuillez v??rifier vos emails.');
                        }
                    }
                    else{
                        $this->request->redirect('/admin/login')->with('error', 'Vos informations de connexion ne coreespondent pas. Veuillez recommencer');
                    }
                }
                else{
                    $this->request->redirect('/admin/login')->with('error', 'Impossible de trouver un compte goSchool associ?? ?? cet e-mail. Veuillez recommencer. ');
                }
            }
            else{
                $this->request->redirect('/admin/login')->with('error', 'Le champ email et le champs mot de passe doivent ??tre remplis.');
            }

        }
    }

    public function logout()
    {
        session_destroy();

        $this->request->redirect('/admin/login')->with('success', 'Vous avez ??t?? d??connectez avec succ??s.');
    }

    public function register()
    {
        if($this->request->isPost()){

            $data = $this->request->getBody();
            
            //['db_user' => $db_user, 'db_password' => $db_password, 'db_name' => $db_name, 'db_host' => $db_host] = $this->request->getBody();
           
            $errors = $this->validator->validate($this->userModel, $data);

            if(empty($errors)){
                if (empty($this->userQuery->getByEmail($data['email'])))
                {
                    if($this->userQuery->create($data))
                    {
                        $verifiedQuery = new UserQuery();
                        $token_verified = $verifiedQuery->getTokenVerified($data['email']);

                        $urlParams = array(
                            "email" => $data['email'],
                            "token_verified" => $token_verified['token_verified'],
                        );

                        $url = new Url();
                        $generateUrl = $url->generateUrlWithParameters('/admin/verify', $urlParams);

                        $email = new UserRegisterValidationEmail();

                        if ($email->sendEmail($data['email'], $generateUrl)){
                            $this->request->redirect('/admin/login')->with('success', 'Votre compte a bien ??t?? cr??er, avant de vous connecter vous devez le v??rifier en cliquant sur le lien re??u par email. ');
                        }
                    }
                }
                else{
                    $this->request->redirect('/admin/register')->with('error', 'Un compte goSchool utilisant cette adresse email existe d??j??.');
                }
            }
            else{
                $this->request->redirect('/admin/register')->with('errors', $errors);
            }
        }
    }

    public function verifyRegister(){

        $dataFromRequest = $this->request->getBody();

        $dataToUpdate = [
            'verified' => 1
        ];

        if(!empty($this->userQuery->getByEmailTokenVerified($dataFromRequest['email'], $dataFromRequest['token_verified']))){

            if ($this->userQuery->updateVerified($dataToUpdate, $dataFromRequest['email'], $dataFromRequest['token_verified'])){

                $this->render("admin/registration/verifyRegister.phtml");

            }
        }
        else{

            $verifiedQuery = new UserQuery();
            $verifiedValue = $verifiedQuery->getByEmailAndToken($dataFromRequest['email'], $dataFromRequest['token_verified']);

            if ($verifiedValue['verified'] == 1){
                $this->request->redirect('/admin/login')->with('error', 'Votre compte goSchool est d??j?? v??rifi??.');
            }
            else{
                die('403 FORBIDDEN');
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