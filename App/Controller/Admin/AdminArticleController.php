<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use App\Model\ArticleModel;
use App\Form\ArticleAddForm;
use App\Form\ArticleEditForm;
use App\Query\ArticleQuery;
use App\Query\UserQuery;
use App\Query\CommentQuery;
use Core\Component\Validator;
use Core\Http\Session;
use Core\Util\RolePermission;

class AdminArticleController extends Controller {

    private $request;

    private $validator;

    private $articleModel;

    private $articleAddForm;

    private $articleEditForm;

    private $articleQuery;

    private $commentQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->articleModel = new ArticleModel();
        $this->articleAddForm = new ArticleAddForm();
        $this->articleEditForm = new ArticleEditForm();
        $this->articleQuery = new ArticleQuery();
        $this->commentQuery = new CommentQuery();
        $this->userQuery = new UserQuery();
        $this->validator = new Validator();

    }

    public function list()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id,'crud_article')){
            $articles = ($this->articleQuery->getArticles());
            $this->render("admin/article/listArticle.phtml", ['articles'=>$articles]);
        }
        elseif($id && $testPermission->has_permission($id,'crud_self_article')){

            $articles = $this->articleQuery->getArticlesByUser($id);
            $this->render("admin/article/listArticle.phtml", ['articles'=>$articles]);
        }
        else{
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.']);
        }
    }

    public function add()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id,'crud_article') || $id && $testPermission->has_permission($id,'crud_self_article') ){
            $form = new ArticleAddForm();
            $articleAddForm = $form->getForm();

            $this->render("admin/article/addArticle.phtml", ['articleAdd'=>$articleAddForm]);
        }
        else{
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.']);
        }
    }

    public function store()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->articleModel, $data);

            $session = new Session();
            $data['user_id'] = $session->getSession('user_id');

            if(empty($errors)){
                if($this->articleQuery->create($data))
                {
                    $this->request->redirect('/admin/article/list', ['flashMessage', 'L\'article a bien été créé']);
                }
                else{
                    $this->request->redirect('/admin/article/list', ['flashMessage', 'Une erreur c\'est produite veuillez réessayer']);
                }
            }
            else {
                $form = new ArticleAddForm();
                $articleAddForm = $form->getForm();
                $this->render("admin/article/addArticle.phtml", ['errors' => $errors, 'articleAdd'=>$articleAddForm]);
            }
        }
    }

    public function edit()
    {
        if($this->request->isGet()) {

            $articleId = $this->request->getBody()['id'];

            $checkPermission = new RolePermission();

            if ($checkPermission->canEditOrDelete($articleId, 'article')) {
                $form = new ArticleEditForm();
                $editArticle = $form->getForm();
                $this->render("admin/article/editArticle.phtml", ['editArticle' => $editArticle]);
            } else {
                $this->request->redirect('/admin/article/list', ['flashMessage', 'Vous n\'avez pas les droits nécessaire pour modifier cet article.']);
            }
        }
    }

    public function update($id)
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->articleModel, $data);

            if(empty($errors)) {

                $updateArticleQuery = new ArticleQuery();

                if($updateArticleQuery->updateArticle($data, $id)) {
                    $this->request->redirect('/admin/article/list', ['flashMessage', 'L\'article a bien été édité']);
                }
                else{
                    $this->request->redirect('/admin/article/list', ['flashMessage', 'Une erreur c\'est produite veuillez réessayer']);
                }
            }else{
                $form = new ArticleEditForm();
                $articleEditForm = $form->getForm();

                $this->render("admin/user/editArticle.phtml", ['errors' => $errors, 'editArticle'=>$articleEditForm]);
            }
        }
    }

    public function delete($id)
    {
        if($this->request->isGet()) {

            $checkPermission = new RolePermission();

            if ($checkPermission->canEditOrDelete($id,'article')){
                $deleteQuery = new ArticleQuery();

                if($deleteQuery->deleteArticle($id)) {

                    $this->request->redirect('/admin/article/list', ['flashMessage', 'L\'article a bien été supprimé']);
                }else {
                    $this->request->redirect('/admin/article/list', ['flashMessage', 'Une erreur c\'est produite veuillez réessayer']);
                    }
            }
            else{
                $this->request->redirect('/admin/article/list', ['flashMessage', 'Vous n\'avez pas les droits nécessaire pour supprimer cet article.']);
            }
        }
    }
}