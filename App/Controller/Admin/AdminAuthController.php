<?php
namespace App\Controller\Admin;

use App\Email\UserResetPasswordEmail;
use App\Form\UserLostPasswordForm;
use App\Form\UserResetPasswordForm;
use App\Model\LostPasswordModel;
use App\Query\LostPasswordQuery;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;
use App\Form\UserLoginForm;
use App\Form\UserRegisterForm;
use App\Model\UserModel;
use Core\Component\Validator;
use App\Query\UserQuery;
use Core\Util\Hash;
use App\Email\UserRegisterValidationEmail;
use Core\Util\TokenGenerator;
use Core\Util\Url;

class AdminAuthController extends Controller{

    private $request;

    private $userRegisterForm;

    private $userModel;

    private $validator;

    private $userQuery;

    private $session;

    private $lostPasswordModel;

    private $lostPasswordQuery;

    private $token;

    private $hashToken;

    public function __construct()
    {
        $this->request = new Request();
        $this->userRegisterForm = new UserRegisterForm();
        $this->userModel = new UserModel();
        $this->validator = new Validator();
        $this->userQuery = new UserQuery();
        $this->session = new Session();
        $this->userLostPasswordForm = new UserLostPasswordForm();
        $this->lostPasswordModel = new LostPasswordModel();
        $this->lostPasswordQuery = new LostPasswordQuery();
        $this->token = new TokenGenerator();
        $this->hashToken = new Hash();
    }

    public function login()
    {

        $form = new UserLoginForm();
        $userLogin = $form->getForm();

        $this->render("admin/registration/login.phtml", ['userLogin'=>$userLogin]);
    }
    
    public function postLogin()
    {
        $hash = new Hash();
        $selectIdQuery = new UserQuery();

        if($this->request->isPost()){

            $data = $this->request->getBody();
            $user = $this->userQuery->getByEmail($data['email']);

            if(!empty($data['email']) && !empty($data['password']) ){

                if(!empty($user)){
                    if($hash->compareHash($data['password'], $user['password_hash'])){
                        if ($user['verified'] == '1'){
                            $this->session->setSession('user_id',$user['id']);
                            $this->request->redirect('/admin/dashboard/index', ['flashMessage', "Vous êtes désormais connecté ! Bienvenue " . $user['fullname'] .  " !"]);
                        }
                        else{
                            $this->request->redirect('/admin/auth/login', ['flashMessage', 'Votre compte n\'est pas validé. Veuillez confirmer votre compte via \'email que nous vous avons envoyé lors de votre inscription.']);
                        }
                    }
                    else{
                        $this->request->redirect('/admin/auth/login', ['flashMessage', 'Vos identifiants ne correpondent pas veuillez réessayer']);
                    }

                }
                else{
                    $this->request->redirect('/admin/auth/login', ['flashMessage', 'Il n\'existe aucun compte GoSchool utilisant cette adresse email.']);
                }
            }
            else{
                $this->request->redirect('/admin/auth/login', ['flashMessage', 'Vous devez fournir un email et un mot de passe']);
            }
        }
    }

    public function logout()
    {
        session_destroy();

        $this->request->redirect('/admin/auth/login', ['flashMessage', 'Vous avez été déconnectez avec succès.']);
    }

    public function register()
    {

        $form = new UserRegisterForm();
        $userRegister = $form->getForm();

        $this->render("admin/registration/register.phtml", ['userRegister'=>$userRegister]);
    }

    public function store()
    {
        if($this->request->isPost()){

            $data = $this->request->getBody();

            $errors = $this->validator->validate($this->userModel, $data);

            if(empty($errors)){
                if (empty($this->userQuery->getByEmail($data['email'])))
                {
                    $createQuery = new UserQuery();
                    if($createQuery->create($data))
                    {
                        $verifiedQuery = new UserQuery();
                        $token_verified = $verifiedQuery->getTokenVerified($data['email']);

                        $urlParams = array(
                            "email" => $data['email'],
                            "token_verified" => $token_verified['token_verified'],
                        );

                        $url = new Url();
                        $generateUrl = $url->generateUrlWithParameters('/admin/auth/verify', $urlParams);

                        $email = new UserRegisterValidationEmail();

                        if ($email->sendEmail($data['email'], $generateUrl)){
                           $this->request->redirect('/admin/auth/login');
                        }
                    }
                }
                else{
                    $this->request->redirect('/admin/auth/register', ['flashMessage', 'Un compte goSchool utilisant cette adresse email existe déjà.']);
                }
            }
            else{
                $form = new UserRegisterForm();
                $userRegister = $form->getForm();

                $this->render("admin/registration/register.phtml", ['userRegister'=>$userRegister, 'errors'=>$errors]);
            }
        }
    }

    public function verify(){

        $dataFromRequest = $this->request->getBody();

        $dataToUpdate = [
            'verified' => '1'
        ];

        if(!empty($this->userQuery->getByEmailTokenVerified($dataFromRequest['email'], $dataFromRequest['token_verified']))){

            $updateQuery = new UserQuery();

            if ($updateQuery->updateVerified($dataToUpdate, $dataFromRequest['email'], $dataFromRequest['token_verified'])){

                $this->render("admin/registration/verifyRegister.phtml");

            }
        }
        else{

            $verifiedQuery = new UserQuery();
            $verifiedValue = $verifiedQuery->getByEmailAndToken($dataFromRequest['email'], $dataFromRequest['token_verified']);

            if ($verifiedValue['verified'] == 1){
             $this->request->redirect('/admin/auth/login', ['flashMessage', 'Votre compte goSchool est déjà vérifié.']);
            }
            else{
                die('403 FORBIDDEN');
            }
        }
    }

    public function lostpassword()
    {
        $form = new UserLostPasswordForm();
        $userLostPasswordForm = $form->getForm();

        $this->render("admin/registration/lostpassword.phtml", ['userLostPassword'=>$userLostPasswordForm]);
    }

    public function postLostPassword()
    {
        if ($this->request->isPost()) {

            $data = $this->request->getBody();
            $emailTo = $data['email'];
            $errors = $this->validator->validate($this->lostPasswordModel, $data);

            if(empty($errors)) {
                if ($emailTo == implode('', $this->userQuery->getEmail($data['email']))) {

                    $token = $this->token->generateToken(32);
                    $hashedToken = $this->hashToken->passwordHash($token);
                    $selector = $this->token->bin2hex($this->token->generateToken(8));
                    $expires = date("U") + 1800;

                    $values = array(
                        "token" => $hashedToken,
                        "selector" => $selector,
                        "expires" => $expires,
                    );
                    $data = array_merge($data, $values);

                    if($this->lostPasswordQuery->create($data))
                    {
                        $urlParams = array(
                            "selector" => $selector,
                            "validator" => $this->token->bin2hex($token),
                        );
                        $url = new Url();
                        $generateUrl = $url->generateUrlWithParameters('/admin/auth/resetpassword', $urlParams);
                        $email = new UserResetPasswordEmail();

                        if ($email->sendEmail($emailTo, $generateUrl)){
                            $this->request->redirect('/admin/auth/lostpassword', ['flashMessage', 'Succès ! Un email de réinitialisation vous a été envoyé !']);
                        }
                        else{
                            $this->request->redirect('/admin/auth/lostpassword', ['flashMessage', 'Impossible de vous envoyez un mail']);
                        }
                    }
                }
                else {
                    $this->request->redirect('/admin/auth/lostpassword', ['flashMessage', 'Erreur, aucun compte goSchool est relié à l\'email fourni.']);
                }
            }
            else{
                $form = new UserLostPasswordForm();
                $userLostPassword = $form->getForm();

                $this->render("admin/registration/lostpassword.phtml", ['errors' => $errors, 'userLostPassword'=>$userLostPassword]);
            }
        }
        else {
            $this->request->redirect('/admin/auth/lostpassword', ['flashMessage', 'Il y a eu une erreur.']);
        }
    }

    public function resetpassword(){

        if($this->request->isGet()){
            $data = $this->request->getBody();
            $selector = $data['selector'];
            $validator = $data['validator'];

            if (empty($selector) || empty($validator))
            {
                $this->request->redirect('/admin/auth/lostpassword', ['flashMessage', 'Impossible de valider votre requête.']);
            }
            else {
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) != false)
                {
                    $form = new UserResetPasswordForm();
                    $userResetPassword = $form->getForm();
                    $this->render("admin/registration/resetpassword.phtml", ['userResetPassword' => $userResetPassword]);
                }
                else{
                    $this->request->redirect('/admin/auth/lostpassword', ['flashMessage', 'Impossible de valider votre requête.']);
                }
            }
        }
    }

    public function postResetPassword(){

        if($this->request->isPost()) {

            $data = $this->request->getBody();
            $validateData = array_slice($data, 2);
            $errors = $this->validator->validate($this->userModel, $validateData);
            $selector = $data['selector'];
            $validator = $data['validator'];
            $password = $data['password'];
            $passwordConfirm = $data['passwordConfirm'];

            if (empty($errors)) {
                $currentDate = date('U');
                $result = $this->lostPasswordQuery->getBySelectorAndExpires($selector, $currentDate);

                $lostPasswordQuery = new LostPasswordQuery();
                if (!$lostPasswordQuery->getBySelectorAndExpires($selector, $currentDate)) {
                    $this->request->redirect('/admin/auth/lostpassword', ['flashMessage', 'Il y a eu une erreur, ce lien de renouvellement de mot de passe a expiré.']);
                } else {
                    $tokenbin = $this->token->hex2bin($validator);
                    $tokenCheck = $this->hashToken->compareHash($tokenbin, $result['token']);

                    if ($tokenCheck === false) {
                        $this->request->redirect('/admin/auth/lostpassword', ['flashMessage', 'Il y a eu une erreur, vous devez refaire une demande de réinitialisation de mot de passe.']);
                    } elseif ($tokenCheck === true) {

                        $tokenEmail = $result['email'];

                        if (!$this->userQuery->getByEmail($tokenEmail)) {
                            $this->request->redirect('/admin/auth/lostpassword', ['flashMessage', 'Il y a eu une erreur, vous devez refaire une demande de réinitialisation de mot de passe.']);
                        } else {
                            $newPasswordHash = $this->hashToken->passwordHash($password);
                            $value = array(
                                "password_hash" => $newPasswordHash,
                            );

                            $userUpdateQuery = new UserQuery();

                            if (!$userUpdateQuery->updatePassword($value, $tokenEmail)) {
                                $this->request->redirect('/admin/auth/lostpassword', ['flashMessage', 'Il y a eu une erreur, vous devez refaire une demande de réinitialisation de mot de passe.']);
                            } else {
                                $this->request->redirect('/admin/auth/login', ['flashMessage', 'Votre demande de réinitialisation de mot de passe a bien été prise en compte. Veuillez vous connecter.']);
                            }
                        }
                    }
                }
            }
            else{
                $form = new UserResetPasswordForm();
                $userResetPassword = $form->getForm();
                $this->render("admin/registration/resetpassword.phtml", ['errors' => $errors, 'userResetPassword' => $userResetPassword]);
            }
        }
    }
}