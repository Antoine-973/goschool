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
            $data['h1_color'] = trim($data['h1_color'],'#');
            $data['h2_color'] = trim($data['h2_color'],'#');
            $data['h3_color'] = trim($data['h3_color'],'#');
            $data['h4_color'] = trim($data['h4_color'],'#');
            $data['p_color'] = trim($data['p_color'],'#');
            $data['nav_bg_color'] = trim($data['nav_bg_color'],'#');
            $data['menu_color'] = trim($data['menu_color'],'#');
            $data['foot_bg_color'] = trim($data['foot_bg_color'],'#');
            $data['foot_color'] = trim($data['foot_color'],'#');
            $data['side_bg_color'] = trim($data['side_bg_color'],'#');
            $data['side_color'] = trim($data['side_color'],'#');
            $idCustom = $data['id'];
            $customQuery = new CustomQuery();
            //var_dump($this->customQuery->update($data, $idCustom));die;
            if($this->customQuery->update($data, $idCustom)){
                $this->request->redirect('/admin/customization/index')->with('success', 'La customisation a bien été ajoutée.');
            }
            else{
                echo "no";die;
                //$this->request->redirect('/admin/customization/index')->with('error', 'Une erreur c\'est produite. Veuillez réessayer.');
            }
        }
    }
}