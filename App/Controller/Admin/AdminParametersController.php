<?php
namespace App\Controller\Admin;

use App\Query\ParamQuery;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;
use Core\Http\Response;
use Core\Component\Validator;

class AdminParametersController extends Controller{

    private $request;

    private $response;

    private $validator;

    private $session;

    private $paramQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->paramQuery = new ParamQuery();
    }

    public function index()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'change_parameters')) {
            $this->render("admin/parameters/param.phtml");
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour accéder au paramètre de GoSchool.']);
        }
    }

    public function update(){
        if ($this->request->isPost()){
            $data = $this->request->getBody();
            //var_dump($data);die;
            $paramQuery = new ParamQuery();
            if ($paramQuery->updateParam($data, '1')){
                $request = new \Core\Http\Request();
                $request->redirect('/admin/parameters/index', ['flashMessage','Les paramètres de GoSchool ont été mis à jour.']);
            }
            else{
                $request = new \Core\Http\Request();
                $request->redirect('/admin/parameters/index', ['flashMessage','Une erreur c\'est produite.']);
            }
        }
    }
}