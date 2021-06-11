<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\ArticleModel;
use App\Form\ArticleAddForm;
use App\Form\ArticleEditForm;
use App\Query\ArticleQuery;
use Core\Component\Validator;

class AdminArticleController extends Controller {

    private $request;

    private $validator;

    private $response;

    private $articleModel;

    private $articleAddForm;

    private $articleEditForm;

    private $articleQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->articleModel = new ArticleModel();
        $this->articleEditForm = new ArticleEditForm();
        $this->articleQuery = new ArticleQuery();
        $this->articleModel = new ArticleModel();
        $this->validator = new Validator();

    }

    public function indexArticle()
    {
        $articles = ($this->articleQuery->getArticles());
        $this->render("admin/article/list.phtml", ['articles'=>$articles]);
    }

    public function add()
    {
        $form = new ArticleAddForm();
        $addArticle = $form->getForm();
        
        $this->render("admin/article/add.phtml", ['addArticle'=>$addArticle]);
        //$this->render("admin/articles/list.phtml");
    }

    public function create()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->articleModel, $data);
            if(!empty($errors)){
                $this->articleQuery->create($data);
                $this->render("admin/article/list.phtml");
            }else{
                $this->render("admin/article/list.phtml");
            }
        } else {
            $form = new ArticleAddForm();
            $addArticle = $form->getForm();
            $this->render("admin/article/add.phtml", ['addArticle'=>$addArticle]);
        }
    }

    public function edit()
    {
        $form = new ArticleEditForm();
        $editArticle = $form->getForm();
        $id = $this->request->getBody();
        $this->render("admin/article/edit.phtml", ['editArticle'=>$editArticle]);
    }

    public function update()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $id = $data['id'];
            $dataToUpdate = array_slice($data, 1);
            $errors = $this->validator->validate($this->articleModel, $dataToUpdate);
            if(empty($errors)) {
                if($this->articleQuery->updateArticle($dataToUpdate, $id)) {
                    $this->request->redirect('/admin/articles')->with('success', 'Mise a jour');
                }
            } else {
                $this->request->redirect('/admin/articles/edit?id=20')->with('errors', $errors);
            }
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        if($this->request->isGet()) {
            if($this->articleQuery->deleteArticle($id)) {
                $this->request->redirect('/admin/articles');
            } else {
                $this->request->redirect('/admin/articles');
            }
        } else {
            $this->request->redirect('/admin/articles');
        }
    }
}