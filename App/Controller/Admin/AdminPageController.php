<?php
namespace App\Controller\Admin;

use App\Form\PageAddForm;
use App\Form\PageEditForm;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\PageModel;
use App\Query\PageQuery;
use Core\Component\Validator;
use Core\Http\Session;
use Core\Util\PhpFileGenerator;
use Core\Util\RolePermission;

class AdminPageController extends Controller {

    private $validator;

    private $request;

    private $response;

    private $pageModel;

    private $pageQuery;


    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->pageModel = new PageModel();
        $this->pageQuery = new PageQuery();
        $this->validator = new Validator();
    }

    public function list()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'crud_page')) {
            $pages = $this->pageQuery->getPages();
            $this->render("admin/page/listPage.phtml", ['pages'=>$pages]);
        }
        elseif($id && $testPermission->has_permission($id,'crud_self_page')){
            $pages = $this->pageQuery->getPagesByUser($id);
            $this->render("admin/page/listPage.phtml", ['pages'=>$pages]);
        }
        else{
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index')->with('error','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.');
        }
    }

    public function add()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id,'crud_article') || $id && $testPermission->has_permission($id,'crud_self_article') ){
            $form = new PageAddForm();
            $pageAddForm = $form->getForm();

            $this->render("admin/page/addPage.phtml", ['pageAdd'=>$pageAddForm]);
        }
        else{
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index')->with('error','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.');
        }
    }

    public function store(){

        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->pageModel, $data);

            $session = new Session();
            $data['user_id'] = $session->getSession('user_id');

            if (empty($errors)){
                if($this->pageQuery->create($data))
                {
                    if ($data['status']=='Publié'){
                        $page = new PhpFileGenerator();

                        if ($page->generateViewFile($data['url'],$data['content'],'pages')){
                            $this->request->redirect('/admin/page/list')->with('success', 'La page a bien été publiée');
                        }
                        else{
                            $this->request->redirect('/admin/page/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                        }
                    }
                    else{
                        $this->request->redirect('/admin/page/list')->with('success', 'La page a bien été créee');
                    }
                }else{
                    $this->request->redirect('/admin/page/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else{
                $form = new PageAddForm();
                $pageAddForm = $form->getForm();
                $this->render("admin/page/addPage.phtml", ['errors'=>$errors, 'pageAdd'=>$pageAddForm]);
            }
        }
    }

    public function edit()
    {
        if($this->request->isGet()) {

            $articleId = $this->request->getBody()['id'];

            $checkPermission = new RolePermission();

            if ($checkPermission->canEditOrDelete($articleId, 'page')) {
                $form = new PageEditForm();
                $pageEditForm = $form->getForm();

                $this->render("admin/page/editPage.phtml", ['pageEdit'=>$pageEditForm]);
            } else {
                $this->request->redirect('/admin/page/list')->with('error', 'Vous n\'avez pas les droits nécessaire pour modifier cette page.');
            }
        }
    }

    public function update($id)
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->pageModel, $data);

            if (empty($errors)) {



                $deleteOldView = new PhpFileGenerator();
                $page = new PhpFileGenerator();
                $urlInDb = $this->pageQuery->getUrlById($id);

                if ($this->pageQuery->updatePage($data, $id)) {

                    if ($data['status']=='Publié'){
                        if ($urlInDb['url'] != $data['url']) {

                            if ($deleteOldView->deleteViewFile($urlInDb['url'], 'pages')) {


                                if ($page->generateViewFile($data['url'], $data['content'], 'pages')) {
                                    $this->request->redirect('/admin/page/list')->with('success', 'La page a bien été édité');
                                } else {
                                    $this->request->redirect('/admin/page/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                                }
                            }
                        }
                        else {
                            if ($page->generateViewFile($data['url'], $data['content'], 'pages')) {
                                $this->request->redirect('/admin/page/list')->with('success', 'La page a bien été édité');
                            } else {
                                $this->request->redirect('/admin/page/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                            }
                        }
                    }
                    else {
                        if ($deleteOldView->deleteViewFile($urlInDb['url'], 'pages')){

                        }
                        $this->request->redirect('/admin/page/list')->with('success', 'La page a bien été édité');
                    }
                }
            }
            else{
                $this->request->redirect('/admin/page/edit?id='.$id)->with('errors', $errors);
            }
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        if($this->request->isGet()) {

            $url = $this->pageQuery->getUrlById($id)['url'];
            $deleteQuery = new PageQuery();

            if($deleteQuery->delete($id)) {

                $deleteView = new PhpFileGenerator();

                if ($deleteView->deleteViewFile($url,'pages')){
                    $this->request->redirect('/admin/page/list')->with('success', 'La page a bien été supprimé');
                }else {
                    $this->request->redirect('/admin/page/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            } else {
                $this->request->redirect('/admin/page/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
            }
        }
    }

}