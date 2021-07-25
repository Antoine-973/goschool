<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;
use Core\Http\Response;
use Core\Component\Validator;
use App\Form\ParamEditForm;

class AdminPlanningController extends Controller{

    private $request;

    private $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function index()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'crud_event') || $id && $testPermission->has_permission($id,'crud_self_event')) {
            $this->render("admin/planning/planning.phtml");
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.']);
        }
    }
}