<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;
use Core\Http\Response;
use Core\Component\Validator;
use App\Form\ParamEditForm;

class AdminParamController extends Controller{

    private $request;

    private $response;

    private $validator;

    private $session;

    private $paramEditForm;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->paramEditForm = new ParamEditForm();
    }

    public function index()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'change_parameters')) {
            $form = new ParamEditForm();
            $paramEditForm = $form->getForm();

            $this->render("admin/parameters/param.phtml", ['paramEditForm'=>$paramEditForm]);
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index')->with('error','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.');
        }
    }
}