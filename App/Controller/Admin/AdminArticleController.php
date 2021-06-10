<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\ArticleModel;
use App\Form\ArticleAddForm;
use App\Form\ArticleEditForm;
use App\Query\ArticleQuery;

class AdminArticleController extends Controller {

    private $request;

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

    }

    public function indexArticle()
    {
        $articles = $this->articleQuery->getArticles();
        print_r($articles);
        $this->render("admin/articles/list.phtml", ['articles'=>$articles]);
    }

    public function add()
    {
        $form = new ArticleAddForm();
        $addArticle = $form->getForm();
        
        $this->render("admin/articles/add.phtml", ['addArticle'=>$addArticle]);
        //$this->render("admin/articles/list.phtml");
    }

    public function create()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            var_dump($data);
            if(!empty($data)){
                $this->articleQuery->create($data);
                $form = new ArticleAddForm();
                $addArticle = $form->getForm();
                $this->render("admin/articles/add.phtml", ['addArticle'=>$addArticle]);
            }else{
                echo "no";
                $form = new ArticleAddForm();
                $addArticle = $form->getForm();
                $this->render("admin/articles/add.phtml", ['addArticle'=>$addArticle]);
            }
        }
    }

    public function edit()
    {
        $form = new ArticleEditForm();
        $editArticle = $form->getForm();
        $this->render("admin/articles/edit.phtml", ['editArticle'=>$editArticle]);
    }

    public function update()
    {
        $id = $_GET['id'];
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            echo $id;
        } else {
            echo "nop";
        }
        $this->render("/admin/article");
    }

    public function delete()
    {
        $id = $_GET['id'];
        if($this->request->isGet()) {
            if($this->articleQuery->deleteArticle($id)) {
                echo "Article numero ".$id. " supprimé";
            } else {
                echo "article non supprimé";
            }
        } else {
            echo "no btn";
        }
    }
}