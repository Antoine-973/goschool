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
        $form = new ParamEditForm();
        $paramEditForm = $form->getForm();

        $this->render("admin/parameters/param.phtml", ['paramEditForm'=>$paramEditForm]);
    }
}