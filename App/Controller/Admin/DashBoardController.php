<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\ArticleModel;
use App\Query\ArticleQuery;

class DashBoardController extends Controller{

    private $request;

    private $response;

    private $articleModel;

    private $articleQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->articleModel = new ArticleModel();
        $this->articleQuery = new ArticleQuery();

    }

    public function index(){
        $articles = $this->articleQuery->orderByTitle();
        var_dump($articles);
        $this->render('admin/index.phtml', ['articles'=>$articles]);
    }
}