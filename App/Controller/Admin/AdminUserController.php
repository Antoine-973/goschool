<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\UserModel;
use App\Form\UserAddForm;
use App\Query\UserQuery;
use Core\Component\Validator;

class AdminUserController extends Controller {

    private $validator;

    private $request;

    private $response;

    private $userModel;

    private $userAddForm;

    private $userQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->userModel = new UserModel();
        $this->userAddForm = new UserAddForm();
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
}