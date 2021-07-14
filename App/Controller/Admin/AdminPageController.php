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
use Core\Util\PhpFileGenerator;

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

    public function indexListPage()
    {
        $pages = $this->pageQuery->getPages();
        $this->render("admin/page/listPage.phtml", ['pages'=>$pages]);
    }

    public function indexAddPage()
    {
        $form = new PageAddForm();
        $pageAddForm = $form->getForm();

        $this->render("admin/page/addPage.phtml", ['pageAdd'=>$pageAddForm]);
    }

    public function addPage(){
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->pageModel, $data);

            if (empty($errors)){
                if($this->pageQuery->create($data))
                {
                    if ($data['status']=='Publié'){
                        $page = new PhpFileGenerator();

                        if ($page->generateViewFile($data['url'],$data['content'],'pages')){
                            $this->request->redirect('/admin/pages')->with('success', 'La page a bien été publiée');
                        }
                        else{
                            $this->request->redirect('/admin/pages')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                        }
                    }
                    else{
                        $this->request->redirect('/admin/pages')->with('success', 'La page a bien été créee');
                    }
                }else{
                    $this->request->redirect('/admin/pages')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else{
                $form = new PageAddForm();
                $pageAddForm = $form->getForm();
                $this->render("admin/page/addPage.phtml", ['errors'=>$errors, 'pageAdd'=>$pageAddForm]);
            }
        }
    }

    public function indexEditPage()
    {
        $form = new PageEditForm();
        $pageEditForm = $form->getForm();

        $this->render("admin/page/editPage.phtml", ['pageEdit'=>$pageEditForm]);
    }

    public function editPage()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $id = $data['id'];
            $dataToUpdate = array_slice($data, 1);
            $errors = $this->validator->validate($this->pageModel, $dataToUpdate);

            if (empty($errors)) {



                $deleteOldView = new PhpFileGenerator();
                $page = new PhpFileGenerator();
                $urlInDb = $this->pageQuery->getUrlById($id);

                if ($this->pageQuery->updatePage($dataToUpdate, $id)) {

                    if ($dataToUpdate['status']=='Publié'){
                        if ($urlInDb['url'] != $data['url']) {

                            if ($deleteOldView->deleteViewFile($urlInDb['url'], 'pages')) {


                                if ($page->generateViewFile($data['url'], $data['content'], 'pages')) {
                                    $this->request->redirect('/admin/pages')->with('success', 'La page a bien été édité');
                                } else {
                                    $this->request->redirect('/admin/pages')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                                }
                            }
                        }
                        else {
                            if ($page->generateViewFile($data['url'], $data['content'], 'pages')) {
                                $this->request->redirect('/admin/pages')->with('success', 'La page a bien été édité');
                            } else {
                                $this->request->redirect('/admin/pages')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                            }
                        }
                    }
                    else {
                        if ($deleteOldView->deleteViewFile($urlInDb['url'], 'pages')){

                        }
                        $this->request->redirect('/admin/pages')->with('success', 'La page a bien été édité');
                    }
                }
            }
            else{
                $form = new PageEditForm();
                $pageEditForm = $form->getForm();
                $this->request->redirect('/admin/page/edit?id='.$id)->with('errors', $errors);
            }
        }
    }

    public function deletePage()
    {
        $id = $_GET['id'];
        if($this->request->isGet()) {

            $url = $this->pageQuery->getUrlById($id)['url'];
            $deleteQuery = new PageQuery();

            if($deleteQuery->delete($id)) {

                $deleteView = new PhpFileGenerator();

                if ($deleteView->deleteViewFile($url,'pages')){
                    $this->request->redirect('/admin/pages')->with('success', 'La page a bien été supprimé');
                }else {
                    $this->request->redirect('/admin/pages')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            } else {
                $this->request->redirect('/admin/pages')->with('error', 'Une erreur c\'est produite veuillez réessayer');
            }
        }
    }

}