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
        $usersTeacher = $this->userQuery->getByRole('professeur');
        $teacherCount = count($usersTeacher);

        $this->userQuery = new UserQuery();
        $usersStudent = $this->userQuery->getByRole('eleve');
        $studentCount = count($usersStudent);

        $articles = $this->articleQuery->orderByDate();
        $this->render('admin/index.phtml', ['articles'=>$articles, 'users'=>$users, 'teacherCount'=>$teacherCount, 'studentCount'=>$studentCount]);
    }
}