<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;
use Core\Http\Response;
use Core\Component\Validator;
use App\Form\ParamEditForm;

class AdminAppearanceController extends Controller{

    private $request;

    private $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function index()
    {
        $this->render("admin/appaerance/listAppearance.phtml");
    }
}