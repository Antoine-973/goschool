<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\UserModel;
use App\Query\UserQuery;
use App\Model\ArticleModel;
use App\Query\ArticleQuery;
use Core\Http\Session;

class AdminDashboardController extends Controller{

    private $request;

    private $response;

    private $articleModel;

    private $articleQuery;

    private $userModel;

    private $userQuery;

    private $session;

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
        $usersTeacher = $this->userQuery->getByRole('Professeur');
        $teacherCount = count($usersTeacher);

        $this->session = new Session();

        $id = $this->session->getSession('user_id') ?? null;
        $connectedUser = [];

        if($id){
            $userQuery = new UserQuery();
           $connectedUser =  $userQuery->getUserById($id);
        }

        $userQuery = new UserQuery();
        $usersStudent = $this->userQuery->getByRole('Abonné');
        $studentCount = count($usersStudent);

        $articles = $this->articleQuery->orderByDate();
        $this->render('admin/index.phtml', ['articles'=>$articles, 'users'=>$users, 'teacherCount'=>$teacherCount, 'studentCount'=>$studentCount]);
    }
}