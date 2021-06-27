<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\UserModel;
use App\Query\UserQuery;
use App\Model\ArticleModel;
use App\Query\ArticleQuery;

class DashBoardController extends Controller{

    private $request;

    private $response;

    private $articleModel;

    private $articleQuery;

    private $userModel;

    private $userQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->articleModel = new ArticleModel();
        $this->articleQuery = new ArticleQuery();
        $this->userModel = new UserModel();
        $this->userQuery = new UserQuery();

    }

    public function index(){
        $users = $this->userQuery->orderByDateRegister();

        $this->userQuery = new UserQuery();
        $usersAdmin = $this->userQuery->getByRole('admin');
        $adminCount = array_count_values($usersAdmin);
        $articles = $this->articleQuery->orderByDate();
        $this->render('admin/index.phtml', ['articles'=>$articles, 'users'=>$users, 'adminCount'=>$adminCount]);
    }
}