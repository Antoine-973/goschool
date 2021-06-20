<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\ArticleModel;

class DashBoardController extends Controller{

    private $request;

    private $response;

    private $articleModel;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->articleModel = new ArticleModel();

    }

    public function index(){
        $articles = ($this->articleQuery->getArticles());
        $this->render('admin/index.phtml', ['articles'=>$articles]);
    }
}