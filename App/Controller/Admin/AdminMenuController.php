<?php

namespace App\Controller\Admin;

use App\Form\SelectMenuForm;
use App\Query\MenuQuery;
use App\Query\PageQuery;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Query\HavePageQuery;

class AdminMenuController extends Controller
{
    private $request;

    private $response;

    private $menuQuery;

    private $pageQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->menuQuery = new MenuQuery();
        $this->pageQuery = new PageQuery();
    }

    public function menu()
    {
        $form = new SelectMenuForm();
        $selectMenuForm = $form->getForm();

        $this->render("admin/menu/menu.phtml", ['selectMenu' => $selectMenuForm]);
    }

    public function select(){

        if ($this->request->isPost()){
            $name =$this->request->getBody()['name'];

            $id = $this->menuQuery->getMenuIdByName($name)['id'];

            $this->request->redirect('/admin/menu/edit?id=' . $id);
        }

    }

    public function add(){

        $pages = $this->pageQuery->getTitleAndId();

        $this->render("admin/menu/addMenu.phtml", ['pages'=>$pages]);
    }

    public function store(){
        if ($this->request->isPost()){
            $data =$this->request->getBody();

            $menuData = array_slice($data,0, 2);
            $pageToAddToMenu = array_slice($data, 2);

            if($this->menuQuery->create($menuData)){

                $menuQueryId = new MenuQuery();
                $idMenu = $menuQueryId->getMenuIdByName($menuData['name']);

                foreach ($pageToAddToMenu as $value){

                    $pageToUpdate = [
                        'menu_id' => $idMenu['id'],
                        'page_id' => $value
                    ];

                    $havePageQuery = new HavePageQuery();
                    $havePageQuery->create($pageToUpdate, $value);
                }
                $this->request->redirect('/admin/menus')->with('success', 'Le menu a bien été créer, vous pouvez maintenant choisir son emplacement dans le site.');
            }else{
                $this->request->redirect('/admin/menus')->with('error', 'Une erreur c\'est produite. Veuillez réessayer.');
            }
        }
    }

    public function edit(){

        $pages = $this->pageQuery->getTitleAndId();

        $this->render("admin/menu/editMenu.phtml", ['pages'=>$pages]);
    }

    public function update(){
        if ($this->request->isPost()){
            $data =$this->request->getBody();

            $menuData = array_slice($data,1, 2);
            $pageToAddToMenu = array_slice($data, 3);

            $idMenu = $data['id'];

            if($this->menuQuery->update($menuData, $idMenu)){

                foreach ($pageToAddToMenu as $value){

                    $pageToUpdate = [
                        'menu_id' => $idMenu,
                        'page_id' => $value
                    ];

                    $havePageQuery = new HavePageQuery();
                    $havePageQuery->update($pageToUpdate, $idMenu, $value);
                }
                $this->request->redirect('/admin/menus')->with('success', 'Le menu a bien été créer, vous pouvez maintenant choisir son emplacement dans le site.');
            }
            /*else{
                $this->request->redirect('/admin/menus')->with('error', 'Une erreur c\'est produite. Veuillez réessayer.');
            }*/
    public function delete()
    {
        $id = $_GET['id'];
        if($this->request->isGet()) {

            $deleteQuery = new MenuQuery();

            if($deleteQuery->delete($id)) {
                $this->request->redirect('/admin/menus')->with('success', 'Le menu a bien été supprimé');
            } else {
                $this->request->redirect('/admin/menus')->with('error', 'Une erreur c\'est produite veuillez réessayer');
            }
        } else {
            $this->request->redirect('/admin/menus')->with('error', 'Une erreur c\'est produite veuillez réessayer');
        }
    }

    public function position(){
        $form = new SelectMenuPositionForm();
        $positionMenu = $form->getForm();

        $this->render("admin/menu/menuPositon.phtml", ['positionMenu' => $positionMenu]);
    }
    }



}