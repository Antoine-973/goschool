<?php


namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use Core\Http\Session;
use App\Query\CustomQuery;

class AdminCustomizationController extends Controller
{
    private $request;

    private $response;

    private $customQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->customQuery = new CustomQuery();
    }

    public function index()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $customQuery = new CustomQuery();
        $customs = $customQuery->getCustom();
        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id,'customize_site') ){
            $this->render("admin/customization/customization.phtml", ['customs'=>$customs]);
        }
        else{
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index')->with('error','Vous n\'avez pas les droits necessaires pour accéder à cette section du back office.');
        }
    }

    public function update(){
        if ($this->request->isPost()){
            $data =$this->request->getBody();

            $customData = array_slice($data,1, 2);
            $pageToAddToMenu = array_slice($data, 3);

            $idCustom = $data['id'];
            $customQuery = new CustomQuery();
            if($this->customQuery->update($customData, $idCustom)){
                $this->request->redirect('/admin/customization/index')->with('success', 'La customisation a bien été ajoutée.');
            }
            else{
                $this->request->redirect('/admin/customization/index')->with('error', 'Une erreur c\'est produite. Veuillez réessayer.');
            }
        }
    }
}