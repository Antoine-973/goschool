<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\UserModel;
use App\Form\UserAddForm;
use App\Form\UserEditForm;
use App\Query\UserQuery;
use Core\Component\Validator;

class AdminUserController extends Controller {

    private $validator;

    private $request;

    private $response;

    private $userModel;

    private $userAddForm;

    private $userQuery;

    private $userEditForm;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->userModel = new UserModel();
        $this->userAddForm = new UserAddForm();
        $this->userEditForm = new UserEditForm();
        $this->userQuery = new UserQuery();
        $this->validator = new Validator();
    }

    public function indexUserManager()
    {
        $users = $this->userQuery->getUsers();
        $this->render("admin/user/userManager.phtml", ['users'=>$users]);
    }

    public function indexAddUser()
    {
        $form = new UserAddForm();
        $userAddForm = $form->getForm();

        $this->render("admin/user/addUser.phtml", ['userAdd'=>$userAddForm]);
    }

    public function addUser()
    {
        if($this->request->isPost()){

            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->userModel, $data);

            if(empty($errors)){
                if($this->userQuery->create($data))
                {
                    $this->request->redirect('/admin/users')->with('success', 'L\'utilisateur a bien été crée');
                }
                else{
                    $this->request->redirect('/admin/users')->with('failed', 'Une erreur c\'est produite veuillez réessayer');
                }
            }else{
                $form = new UserAddForm();
                $userAddForm = $form->getForm();

                $this->render("admin/user/addUser.phtml", ['errors' => $errors, 'userAdd'=>$userAddForm]);
            }
        }
    }

    public function indexEditUser()
    {
        $form = new UserEditForm();
        $editUser = $form->getForm();
        $id = $this->request->getBody();

        $this->render("admin/user/editUser.phtml", ['editUser'=>$editUser]);
    }

    public function editUser()
    {
        if($this->request->isPost()){

            $data = $this->request->getBody();
            $id = $data['id'];
            $dataToUpdate = array_slice($data, 1);

            $errors = $this->validator->validate($this->userModel, $data);

            if(empty($errors)){
                if($this->userQuery->update($dataToUpdate, $id))
                {
                    $this->request->redirect('/admin/users')->with('success', 'L\'utilisateur a bien été édité');
                }
                else{
                    $this->request->redirect('/admin/users')->with('failed', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else{
                $form = new UserEditForm();
                $userEditForm = $form->getForm();

                $this->render("admin/user/editUser.phtml", ['editUser'=>$userEditForm]);
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

    public function deleteUser()
    {
        $id = $_GET['id'];
        if($this->request->isGet()) {
            if($this->userQuery->delete($id)) {
                $this->request->redirect('/admin/users')->with('success', 'L\'utilisateur a bien été supprimé');
            } else {
                $this->request->redirect('/admin/users')->with('failed', 'Une erreur c\'est produite veuillez réessayer');
            }
        } else {
            $this->request->redirect('/admin/users')->with('failed', 'Une erreur c\'est produite veuillez réessayer');
        }
    }
}