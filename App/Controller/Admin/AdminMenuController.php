<?php

namespace App\Controller\Admin;

use App\Form\MenuAddForm;
use App\Form\MenuEditForm;
use App\Form\SelectMenuForm;
use App\Query\MenuQuery;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;

class AdminMenuController extends Controller
{
    private $request;

    private $response;

    private $menuQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->menuQuery = new MenuQuery();
    }

    public function indexSelectMenu()
    {
        $form = new SelectMenuForm();
        $selectMenuForm = $form->getForm();

        $this->render("admin/menu/menu.phtml", ['selectMenu' => $selectMenuForm]);
    }

    public function selectMenu(){

        if ($this->request->isPost()){
            $name =$this->request->getBody()['name'];

            $id = $this->menuQuery->getMenuIdByName($name)['id'];

            $this->request->redirect('/admin/menu/edit?id=' . $id);
        }

    }

    public function indexEditMenu(){
        $form = new MenuEditForm();
        $editMenuForm = $form->getForm();

        $this->render("admin/menu/editMenu.phtml", ['editMenu' => $editMenuForm]);
    }



}