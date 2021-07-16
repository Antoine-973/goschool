<?php

namespace App\Controller\Admin;

use App\Form\SelectMenuForm;
use App\Form\SelectMenuPositionForm;
use App\Query\MenuQuery;
use App\Query\PageQuery;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Query\HavePageQuery;
use Core\Http\Session;

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

    public function index()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'crud_menu')) {
            $form = new SelectMenuForm();
            $selectMenuForm = $form->getForm();

            $this->render("admin/menu/menu.phtml", ['selectMenu' => $selectMenuForm]);
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index')->with('error','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.');
        }
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

                foreach ($pageToAddToMenu as $page_id){

                    $pageToUpdate = [
                        'menu_id' => $idMenu['id'],
                        'page_id' => $page_id
                    ];

                    $havePageQuery = new HavePageQuery();

                    if (!$page_id == '0'){
                        $havePageQuery->create($pageToUpdate, $page_id);
                    }
                }
                $this->request->redirect('/admin/menu/index')->with('success', 'Le menu a bien été créer, vous pouvez maintenant choisir son emplacement dans le site.');
            }else{
                $this->request->redirect('/admin/menu/index')->with('error', 'Une erreur c\'est produite. Veuillez réessayer.');
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
                foreach ($pageToAddToMenu as $titre => $page_id){

                    $pageToUpdate = [
                        'menu_id' => $idMenu,
                        'page_id' => $page_id
                    ];

                    $havePageQuery = new HavePageQuery();
                    $pageQuery = new PageQuery();

                    if ($page_id == '0'){

                        $pageToUpdate['page_id'] = $pageQuery->getIdByTitle($titre)['id'];

                        if (!empty($havePageQuery->getById($pageToUpdate['menu_id'], $pageToUpdate['page_id']))){
                            $deleteHavePage = new HavePageQuery();
                            $deleteHavePage->delete($pageToUpdate['menu_id'], $pageToUpdate['page_id']);
                        }
                    }
                    else{
                        if (empty($havePageQuery->getById($pageToUpdate['menu_id'], $pageToUpdate['page_id']))){
                            $havePageQuery->create($pageToUpdate);
                        }
                    }
                }
                $this->request->redirect('/admin/menu/index')->with('success', 'Le menu a bien été créer, vous pouvez maintenant choisir son emplacement dans le site.');
            }
            else{
                $this->request->redirect('/admin/menu/index')->with('error', 'Une erreur c\'est produite. Veuillez réessayer.');
            }
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        if($this->request->isGet()) {

            $deleteQuery = new MenuQuery();

            if($deleteQuery->delete($id)) {
                $this->request->redirect('/admin/menu/index')->with('success', 'Le menu a bien été supprimé');
            } else {
                $this->request->redirect('/admin/menu/index')->with('error', 'Une erreur c\'est produite veuillez réessayer');
            }
        } else {
            $this->request->redirect('/admin/menu/index')->with('error', 'Une erreur c\'est produite veuillez réessayer');
        }
    }

    public function position(){
        $form = new SelectMenuPositionForm();
        $positionMenu = $form->getForm();

        $this->render("admin/menu/menuPositon.phtml", ['positionMenu' => $positionMenu]);
    }

    public function postPosition(){

        $data =$this->request->getBody();

        foreach ($data as $position => $menu){

            $resetMenuPositionQuery = new MenuQuery();

            if ($menu != 'Aucun'){

                if (!empty($resetMenuPositionQuery->getPositionByPosition($position))){
                    $dataToUpdate = [
                        'position' => NULL
                    ];

                    $resetMenuPositionQuery->updatePositionToNull($dataToUpdate, $position);
                }

                $menuPositionQuery = new MenuQuery();

                $dataToUpdate = [
                    'position' => $position
                ];

                $id = $menuPositionQuery->getMenuIdByName($menu)['id'];

                if ($menuPositionQuery->update($dataToUpdate,$id)){
                }
            }
            else{
                if (!empty($resetMenuPositionQuery->getPositionByPosition($position))){
                    $dataToUpdate = [
                        'position' => NULL
                    ];

                    $resetMenuPositionQuery->updatePositionToNull($dataToUpdate, $position);
                }
            }
        }
        $this->request->redirect('/admin/menu/index')->with('success', 'Les positions des menus ont été modifié.');
    }



}