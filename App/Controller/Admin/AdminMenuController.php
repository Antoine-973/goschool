<?php

namespace App\Controller\Admin;

use App\Form\SelectMenuForm;
use App\Form\SelectMenuPositionForm;
use App\Model\MenuModel;
use App\Query\MenuQuery;
use App\Query\PageQuery;
use Core\Component\Validator;
use Core\Controller;
use Core\Http\Request;
use App\Query\HavePageQuery;
use Core\Http\Session;

class AdminMenuController extends Controller
{
    private $request;

    private $menuQuery;

    private $pageQuery;

    private $menuModel;

    private $validator;

    public function __construct()
    {
        $this->request = new Request();
        $this->menuQuery = new MenuQuery();
        $this->pageQuery = new PageQuery();
        $this->menuModel = new MenuModel();
        $this->validator = new Validator();
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
            $request->redirect('/admin/dashboard/index', ['error','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.']);
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
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'crud_menu')) {
            $pages = $this->pageQuery->getTitleAndId();

            $this->render("admin/menu/addMenu.phtml", ['pages'=>$pages]);
        }else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['error','Vous n\'avez pas les droits nécessaires pour ajouter des menus.']);
        }
    }

    public function store(){
        if ($this->request->isPost()){
            $data =$this->request->getBody();
            $errors = $this->validator->validate($this->menuModel, $data);

            if(empty($errors)){
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
                    $this->request->redirect('/admin/menu/index', ['flashMessage', 'Le menu a bien été créer, vous pouvez maintenant choisir son emplacement dans le site.']);
                }else{
                    $this->request->redirect('/admin/menu/index', ['flashMessage', 'Une erreur c\'est produite. Veuillez réessayer.']);
                }
            }
            else{
                $pages = $this->pageQuery->getTitleAndId();

                $this->render("admin/menu/addMenu.phtml", ['errors'=>$errors, 'pages'=>$pages]);
            }
        }
    }

    public function edit(){
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'crud_menu')) {
            $pages = $this->pageQuery->getTitleAndId();

            $this->render("admin/menu/editMenu.phtml", ['pages'=>$pages]);
        }else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour ajouter des menus.']);
        }
    }

    public function update(){
        if ($this->request->isPost()){
            $data =$this->request->getBody();
            $errors = $this->validator->validate($this->menuModel, $data);

            if(empty($errors)){
                $menuData = array_slice($data,1, 2);
                $pageToAddToMenu = array_slice($data, 3);

                $idMenu = $data['id'];

                $updateMenuQuery = new MenuQuery();
                if($updateMenuQuery->update($menuData, $idMenu)){
                    foreach ($pageToAddToMenu as $titre => $page_id){

                        $pageToUpdate = [
                            'menu_id' => $idMenu,
                            'page_id' => $page_id
                        ];

                        $havePageQuery = new HavePageQuery();
                        $pageQuery = new PageQuery();

                        if ($page_id == '0'){

                            if (strpos($titre, '_') !== false) {
                                $titre = str_replace('_', ' ', $titre);
                            }

                            $pageId = $pageQuery->getIdByTitle($titre)['id'];
                            $pageToUpdate['page_id'] = $pageId;

                            if (!empty($havePageQuery->getById($pageToUpdate['menu_id'], $pageToUpdate['page_id']))){
                                $deleteHavePage = new HavePageQuery();
                                $deleteHavePage->delete($pageToUpdate['menu_id'], $pageToUpdate['page_id']);
                            }
                        }
                        else{
                            $getIdQuery = new HavePageQuery();
                            if (empty($getIdQuery->getById($pageToUpdate['menu_id'], $pageToUpdate['page_id']))){
                                $createQuery = new HavePageQuery();
                                $createQuery->create($pageToUpdate);
                            }
                        }
                    }
                    $this->request->redirect('/admin/menu/index', ['flashMessage', 'Le menu a bien été créer, vous pouvez maintenant choisir son emplacement dans le site.']);
                }
                else{
                    $this->request->redirect('/admin/menu/index', ['flashMessage', 'Une erreur c\'est produite. Veuillez réessayer.']);
                }
            }
            else{
                $pages = $this->pageQuery->getTitleAndId();

                $this->render("admin/menu/editMenu.phtml", ['errors'=>$errors, 'pages'=>$pages]);
            }
        }
    }

    public function delete($id)
    {
        if($this->request->isGet()) {
            $session = new Session();
            $user_id = $session->getSession('user_id');

            $testPermission = new \Core\Util\RolePermission();

            if ($user_id && $testPermission->has_permission($user_id, 'crud_menu')) {
                $deleteQuery = new MenuQuery();

                if($deleteQuery->delete($id)) {
                    $this->request->redirect('/admin/menu/index', ['flashMessage', 'Le menu a bien été supprimé']);
                } else {
                    $this->request->redirect('/admin/menu/index', ['flashMessage', 'Une erreur c\'est produite veuillez réessayer']);
                }
            }else {
                $request = new \Core\Http\Request();
                $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour supprimer des menus.']);
            }
        }
    }

    public function position(){
        $session = new Session();
        $user_id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($user_id && $testPermission->has_permission($user_id, 'change_menu_position')) {
            $form = new SelectMenuPositionForm();
            $positionMenu = $form->getForm();

            $this->render("admin/menu/menuPositon.phtml", ['positionMenu' => $positionMenu]);
        }else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour supprimer des menus.']);
        }
    }

    public function postPosition(){

        $data =$this->request->getBody();

        foreach ($data as $position => $menu){

            if ($menu != 'Aucun'){

                $getPosition = new MenuQuery();

                if (!empty($getPosition->getPositionByPosition($position))){
                    $dataToUpdate = [
                        'position' => NULL
                    ];

                    $resetMenuPositionQuery = new MenuQuery();

                    $resetMenuPositionQuery->updatePositionToNull($dataToUpdate, $position);
                }

                $menuPositionQuery = new MenuQuery();

                $dataToUpdate = [
                    'position' => $position
                ];

                $id = $menuPositionQuery->getMenuIdByName($menu)['id'];

                $menuUpdateQuery = new MenuQuery();
                $menuUpdateQuery->update($dataToUpdate,$id);
            }
            else{

                $getMenuId = new MenuQuery();

                $idMenu = $getMenuId->getPositionByPosition($position);

                if (!empty($idMenu)){

                    $dataToUpdate = [
                        'position' => NULL
                    ];

                    $updateMenuQuery = new MenuQuery();
                    $updateMenuQuery->updatePositionToNull($dataToUpdate, $position);
                }
            }
        }
        $this->request->redirect('/admin/menu/index', ['flashMessage', 'Les positions des menus ont été modifié.']);
    }



}