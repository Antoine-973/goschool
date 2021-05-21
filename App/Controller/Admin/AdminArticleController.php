<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\ArticleModel;
use App\Form\ArticleAddForm;
use App\Query\ArticleQuery;

class AdminArticleController extends Controller {

    private $request;

    private $response;

    private $articleModel;

    private $articleAddForm;

    private $articleQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->articleModel = new ArticleModel();
        $this->articleAddForm = new ArticleAddForm();
        $this->articleQuery = new ArticleQuery();
        $this->articleModel = new ArticleModel();

    }

    public function indexArticle()
    {

        $articles = $this->articleQuery->getArticles();
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
}