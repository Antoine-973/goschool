<?php
namespace App\Controller;
use App\Model\CommentModel;
use App\Model\UserModel;
use App\Query\ArticleQuery;
use App\Query\CommentQuery;
use App\Query\UserQuery;
use Core\Component\Validator;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;

class HomeController extends Controller{

    private $validator;

    private $request;

    private $commentQuery;

    private $userQuery;

    private $articleQuery;

    private $commentModel;

    private $userModel;

    private $session;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->request = new Request();
        $this->commentQuery = new CommentQuery();
        $this->userQuery = new UserQuery();
        $this->articleQuery = new ArticleQuery();
        $this->commentModel = new CommentModel();
        $this->userModel = new UserModel();
        $this->session = new Session();
    }

    public function index(){

        return $this->render("site/pages/sample_page.phtml");
    }

    public function article(){
        $request = new Request();
        $path = $request->getPath();
        $arr = explode('/', $path);

        if (count($arr) == '3'){
            return $this->render("site/pages/sample_page.phtml");
        }
    }

    public function storeComment(){
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->commentModel, $data);
            $slug = $data['slug'];
            unset($data['slug']);

            $idArticle = $this->articleQuery->getArticleIdBySlug($slug)['id'];

            $data['article_id'] = $idArticle;
            $data['user_id'] = $this->session->getSession('user_id');

            if(empty($errors)){
                if($this->commentQuery->create($data))
                {
                    $this->request->redirect('/article/' . $slug)->with('success', 'Le commentaire a bien été publié');
                }
                else{
                    $this->request->redirect('/article/' . $slug)->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
        }
    }
}