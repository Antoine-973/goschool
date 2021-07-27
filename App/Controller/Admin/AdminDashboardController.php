<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use App\Model\UserModel;
use App\Query\UserQuery;
use App\Model\ArticleModel;
use App\Query\ArticleQuery;
use Core\Http\Session;

class AdminDashboardController extends Controller{

    private $request;

    private $articleModel;

    private $articleQuery;

    private $userModel;

    private $userQuery;

    private $session;

    public function __construct()
    {
        $this->request = new Request();
        $this->articleModel = new ArticleModel();
        $this->articleQuery = new ArticleQuery();
        $this->userModel = new UserModel();
        $this->userQuery = new UserQuery();

    }

    public function index(){
        $users = $this->userQuery->orderByDateRegister();
        
        $articleQuery = new ArticleQuery();
        $articles = $articleQuery->orderByDate();

        $this->session = new Session();
        $id = $this->session->getSession('user_id') ?? null;
        $connectedUser = [];

        if($id){
            $userQuery = new UserQuery();
           $connectedUser =  $userQuery->getUserById($id);
        }

        $userQuery = new UserQuery();
        $usersTeacher = $userQuery->getByRole('Professeur');
        $teacherCount = count($usersTeacher);
        $userQuery = new UserQuery();
        $usersStudent = $userQuery->getByRole('Abonné');
        $subscribersCount = count($usersStudent);
        $userQuery = new UserQuery();
        $usersAdmin = $userQuery->getByRole('Administrateur');
        $adminCount = count($usersAdmin);
        $userQuery = new UserQuery();
        $usersEdit = $userQuery->getByRole('Éditeur');
        $editCount = count($usersEdit);
        $userQuery = new UserQuery();
        $usersAutor = $userQuery->getByRole('Auteur');
        $autorCount = count($usersAutor);
        $userQuery = new UserQuery();
        $usersSchool = $userQuery->getByRole('Vie-Scolaire');
        $studentEditorCount = count($usersSchool);
        $userQuery = new UserQuery();
        $usersSchool = $userQuery->getByRole('Élève-Rédacteur');
        $schoolCount = count($usersSchool);
        $userQuery = new UserQuery();
        $getUserByRole = $userQuery->getByRole('Élève');
        $studentCount = count($usersSchool);
        $userQuery = new UserQuery();
        $usersSchool = $userQuery->getByRole('Vie-Scolaire');
        $this->render('admin/index.phtml', [
            'articles'=>$articles, 
            'users'=>$users,
            'editCount'=>$editCount,
            'adminCount'=>$adminCount,
            'autorCount'=>$autorCount,
            'schoolCount'=>$schoolCount,
            'teacherCount'=>$teacherCount,
            'studentEditorCount'=>$studentEditorCount,
            'studentCount'=>$studentCount,
            'subscribersCount'=>$subscribersCount,

        ]);
    }
}