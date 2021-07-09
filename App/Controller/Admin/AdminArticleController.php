<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\ArticleModel;
use App\Form\ArticleAddForm;
use App\Form\ArticleEditForm;
use App\Query\ArticleQuery;
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

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->articleModel = new ArticleModel();
        $this->articleAddForm = new ArticleAddForm();
        $this->articleEditForm = new ArticleEditForm();
        $this->articleQuery = new ArticleQuery();
        $this->validator = new Validator();

    }

    public function indexListArticle()
    {
        $articles = ($this->articleQuery->getArticles());
        $this->render("admin/article/listArticle.phtml", ['articles'=>$articles]);
    }

    public function indexAddArticle()
    {
        $form = new ArticleAddForm();
        $articleAddForm = $form->getForm();
        
        $this->render("admin/article/addArticle.phtml", ['articleAdd'=>$articleAddForm]);
    }

    public function addArticle()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->articleModel, $data);

            if(empty($errors)){
                if($this->articleQuery->create($data))
                {
                    $article = new PhpFileGenerator();

                    if ($article->generateViewFile($data['title'],$data['content'],'articles')) {
                        $this->request->redirect('/admin/articles')->with('success', 'L\'article a bien été crée');
                    }
                    else{
                        $this->request->redirect('/admin/articles')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                    }
                }
                else{
                    $this->request->redirect('/admin/articles')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else {
                $form = new ArticleAddForm();
                $articleAddForm = $form->getForm();
                $this->render("admin/article/addArticle.phtml", ['errors' => $errors, 'articleAdd'=>$articleAddForm]);
            }
        }
    }

    public function indexEditArticle()
    {
        $form = new ArticleEditForm();
        $editArticle = $form->getForm();
        $id = $this->request->getBody();
        $this->render("admin/article/editArticle.phtml", ['editArticle'=>$editArticle]);
    }

    public function editArticle()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $id = $data['id'];
            $dataToUpdate = array_slice($data, 1);
            $errors = $this->validator->validate($this->articleModel, $dataToUpdate);

            if(empty($errors)) {
                $slugInDb = $this->articleQuery->getSlugById($id);

                if ($slugInDb['slug'] != $data['slug']) {
                    $deleteOldView = new PhpFileGenerator();

                    if ($deleteOldView->deleteViewFile($slugInDb['slug'], 'articles')) {
                        if($this->articleQuery->updateArticle($dataToUpdate, $id)) {
                            $article = new PhpFileGenerator();

                            if ($article->generateViewFile($data['slug'],$data['content'],'articles')) {
                                $this->request->redirect('/admin/articles')->with('success', 'L\'article a bien été édité');
                            }
                            else{
                                $this->request->redirect('/admin/articles')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                            }
                        }
                        else{
                            $this->request->redirect('/admin/articles')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                        }
                    }
                    else{
                        die('KO');
                    }
                }
            }
            else{
                $form = new ArticleEditForm();
                $articleEditForm = $form->getForm();

                $this->render("admin/user/editArticle.phtml", ['errors' => $errors, 'editArticle'=>$articleEditForm]);
            }
        }
    }

    public function deleteArticle()
    {
        $id = $_GET['id'];
        if($this->request->isGet()) {

            $slug = $this->articleQuery->getSlugById($id)['slug'];
            $deleteQuery = new ArticleQuery();

            if($deleteQuery->deleteArticle($id)) {

                $deleteView = new PhpFileGenerator();

                if ($deleteView->deleteViewFile($slug,'articles')){
                    $this->request->redirect('/admin/articles')->with('success', 'L\'article a bien été supprimé');
                }else {
                    $this->request->redirect('/admin/articles')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            } else {
                $this->request->redirect('/admin/articles')->with('error', 'Une erreur c\'est produite veuillez réessayer');
            }
        } else {
            $this->request->redirect('/admin/articles')->with('error', 'Une erreur c\'est produite veuillez réessayer');
        }
    }
}