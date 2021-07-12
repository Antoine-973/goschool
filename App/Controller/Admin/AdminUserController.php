<?php
namespace App\Controller\Admin;

use App\Form\UserProfileForm;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\UserModel;
use App\Form\UserAddForm;
use App\Form\UserEditForm;
use App\Query\UserQuery;
use Core\Component\Validator;
use Core\Http\Session;

class AdminUserController extends Controller {

    private $validator;

    private $request;

    private $response;

    private $userModel;

    private $userAddForm;

    private $userQuery;

    private $userEditForm;

    private $session;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->userModel = new UserModel();
        $this->userAddForm = new UserAddForm();
        $this->userEditForm = new UserEditForm();
        $this->userQuery = new UserQuery();
        $this->validator = new Validator();
        $this->session = new Session();
    }

    public function profil(){
        $form = new UserProfileForm();
        $userProfileForm = $form->getForm();

        $this->render("admin/user/userProfile.phtml", ['userProfile'=>$userProfileForm]);
    }

    public function update(){

        if($this->request->isPost()){

            $data = $this->request->getBody();
            $id = $this->session->getSession('id');

            $errors = $this->validator->validate($this->userModel, $data);

            if(empty($errors)){
                if($this->userQuery->update($data, $id))
                {
                    $this->request->redirect('/admin/user/list')->with('edited', 'Votre profil a bien été modifié');
                }
                else{
                    $this->request->redirect('/admin/user/list')->with('failed', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else{
                $form = new UserProfileForm();
                $userProfileForm = $form->getForm();

                $this->render("admin/user/userProfile.phtml", ['errors' => $errors, 'userProfile'=>$userProfileForm]);
            }
        }
    }

    public function list()
    {
        $users = $this->userQuery->getUsers();
        $this->render("admin/user/listUser.phtml", ['users'=>$users]);
    }

    public function add()
    {
        $form = new UserAddForm();
        $userAddForm = $form->getForm();

        $this->render("admin/user/addUser.phtml", ['userAdd'=>$userAddForm]);
    }

    public function store()
    {
        if($this->request->isPost()){

            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->userModel, $data);

            if(empty($errors)){
                if($this->userQuery->create($data))
                {
                    $this->request->redirect('/admin/user/list')->with('success', 'L\'utilisateur a bien été crée');
                }
                else{
                    $this->request->redirect('/admin/user/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }else{
                $form = new UserAddForm();
                $userAddForm = $form->getForm();

                $this->render("admin/user/addUser.phtml", ['errors' => $errors, 'userAdd'=>$userAddForm]);
            }
        }
    }

    public function edit()
    {
        $form = new UserEditForm();
        $editUser = $form->getForm();
        $id = $this->request->getBody();

        $this->render("admin/user/editUser.phtml", ['editUser'=>$editUser]);
    }

    public function updateProfile($id)
    {
        if($this->request->isPost()){

            $data = $this->request->getBody();
            $dataToUpdate = array_slice($data, 1);

            $errors = $this->validator->validate($this->userModel, $dataToUpdate);

            if(empty($errors)){
                if($this->userQuery->update($dataToUpdate, $id))
                {
                    $this->request->redirect('/admin/user/list')->with('success', 'L\'utilisateur a bien été édité');
                }
                else{
                    $this->request->redirect('/admin/user/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else{
                $form = new UserEditForm();
                $userEditForm = $form->getForm();

                $this->render("admin/user/editUser.phtml", ['errors' => $errors, 'editUser'=>$userEditForm]);
            }
        }
    }

    public function indexDeleteUser()
    {
        $id = $_GET['id'];
        $firstname = $this->userQuery->getFirstname();
        $lastname = $this->userQuery->getLastname();
        $this->render("admin/user/deleteUser.phtml");
    }

    public function delete($id)
    {
        if($this->request->isGet()) {
            if($this->session->getSession('id') != $id){
                if($this->userQuery->delete($id)) {
                    $this->request->redirect('/admin/user/list')->with('deleted', 'L\'utilisateur a bien été supprimé');
                } else {
                    $this->request->redirect('/admin/user/list')->with('failed', 'Une erreur c\'est produite veuillez réessayer');
                }
            }else {
                $this->request->redirect('/admin/user/list')->with('failed', 'Impossible de supprimer votre propre compte.');
            }
        }
    }
}