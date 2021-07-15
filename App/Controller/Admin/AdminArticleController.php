<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Database\QueryBuilder;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\ArticleModel;
use App\Form\ArticleAddForm;
use App\Form\ArticleEditForm;
use App\Query\ArticleQuery;
use App\Query\UserQuery;
use App\Query\CommentQuery;
use Core\Component\Validator;
use Core\Util\PhpFileGenerator;

class AdminArticleController extends Controller {

    private $request;

    private $validator;

    private $response;

    private $articleModel;

    private $articleAddForm;

    private $articleEditForm;

    private $articleQuery;

    private $commentQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
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
        $articles = ($this->articleQuery->getArticles());
        $this->render("admin/article/listArticle.phtml", ['articles'=>$articles]);
    }

    public function add()
    {
        $form = new ArticleAddForm();
        $articleAddForm = $form->getForm();
        
        $this->render("admin/article/addArticle.phtml", ['articleAdd'=>$articleAddForm]);
    }

    public function store()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->articleModel, $data);

            if(empty($errors)){
                if($this->articleQuery->create($data))
                {
                    if ($data['status']=='Publié'){
                        $article = new PhpFileGenerator();

                        $this->request->redirect('/admin/article/list')->with('success', 'L\'article a bien été crée');
                        if ($article->generateViewFile($data['title'],$data['content'],'articles')) {
                            $this->request->redirect('/admin/article/list')->with('success', 'L\'article a bien été publié');
                        }
                        else{
                            $this->request->redirect('/admin/article/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                        }
                    }
                    else{
                        $this->request->redirect('/admin/article/list')->with('success', 'L\'article a bien été crée');
                    }
                }
                else{
                    $this->request->redirect('/admin/article/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
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
        $form = new ArticleEditForm();
        $editArticle = $form->getForm();
        $id = $this->request->getBody();
        $this->render("admin/article/editArticle.phtml", ['editArticle'=>$editArticle]);
    }

    public function update($id)
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->articleModel, $data);

            if(empty($errors)) {

                $updateArticleQuery = new ArticleQuery();
                $slugQuery = new ArticleQuery();

                $slugInDb = $slugQuery->getSlugById($id);
                $deleteOldView = new PhpFileGenerator();

                if($updateArticleQuery->updateArticle($data, $id)) {

                    if ($data['status']=='Publié'){

                        if ($slugInDb['slug'] != $data['slug']) {

                            if ($deleteOldView->deleteViewFile($slugInDb['slug'], 'articles')) {
                                $article = new PhpFileGenerator();

                                if ($article->generateViewFile($data['slug'],$data['content'],'articles')) {
                                    $this->request->redirect('/admin/article/list')->with('success', 'L\'article a bien été édité');
                                }
                                else{
                                    $this->request->redirect('/admin/article/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                                }
                            }
                        }
                        else{
                            $article = new PhpFileGenerator();

                            if ($article->generateViewFile($data['slug'],$data['content'],'articles')) {
                                $this->request->redirect('/admin/article/list')->with('success', 'L\'article a bien été édité');
                            }
                            else{
                                $this->request->redirect('/admin/article/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                            }
                        }
                    }
                    else {
                        if ($deleteOldView->deleteViewFile($slugInDb['slug'], 'articles')){

                        }
                        $this->request->redirect('/admin/article/list')->with('success', 'L\'article a bien été édité');
                    }
                }
                else{
                    $this->request->redirect('/admin/article/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else{
                $form = new ArticleEditForm();
                $articleEditForm = $form->getForm();

                $this->render("admin/user/editArticle.phtml", ['errors' => $errors, 'editArticle'=>$articleEditForm]);
            }
        }
    }

    public function delete($id)
    {
 
        if($this->request->isGet()) {

            $slug = $this->articleQuery->getSlugById($id)['slug'];
            $deleteQuery = new ArticleQuery();

            if($deleteQuery->deleteArticle($id)) {

                $deleteView = new PhpFileGenerator();

                if ($deleteView->deleteViewFile($slug,'articles')){
                    $this->request->redirect('/admin/article/list')->with('success', 'L\'article a bien été supprimé');
                }else {
                    $this->request->redirect('/admin/article/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            } else {
                $this->request->redirect('/admin/article/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
            }
        } else {
            $this->request->redirect('/admin/article/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
        }
    }
}