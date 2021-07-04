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

            if($this->pageQuery->create($data))
            {
                $page = new PhpFileGenerator();

                if ($page->generateViewFile($data['title'],$data['content'],'pages')){
                    $this->request->redirect('/admin/pages')->with('created', 'La page a bien été créee');
                }
            }
            else{
                $this->request->redirect('/admin/pages')->with('failed', 'Une erreur c\'est produite veuillez réessayer');
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

            if($this->pageQuery->updatePage($dataToUpdate, $id)) {
                $this->request->redirect('/admin/pages')->with('edited', 'La page a bien été édité');
            }
            else{
                $this->request->redirect('/admin/pages')->with('failed', 'Une erreur c\'est produite veuillez réessayer');
            }
        }
    }

    public function deletePage()
    {
        $id = $_GET['id'];
        if($this->request->isGet()) {
            if($this->pageQuery->delete($id)) {
                $this->request->redirect('/admin/pages')->with('deleted', 'La page a bien été supprimé');
            } else {
                $this->request->redirect('/admin/pages')->with('failed', 'Une erreur c\'est produite veuillez réessayer');
            }
        } else {
            $this->request->redirect('/admin/pages')->with('failed', 'Une erreur c\'est produite veuillez réessayer');
        }
    }

}