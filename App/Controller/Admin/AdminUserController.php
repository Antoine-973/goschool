<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\UserModel;
use App\Form\UserAddForm;
use App\Query\UserQuery;

class AdminUserController extends Controller {

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
    }

    public function indexUserManager()
    {
        $this->render("admin/user/userManager.phtml");
    }

    public function indexAddUser()
    {
        $form = new UserAddForm();
        $userAddForm = $form->getForm();

        $this->render("admin/user/addUser.phtml", ['userAdd'=>$userAddForm]);
    }

    public function addUser()
    {

    }
}