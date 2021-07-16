<?php
namespace App\Controller\Admin;

use Core\Component\Validator;
use Core\Http\Request;
use Core\Controller;
use App\Form\CommentAddForm;
use App\Form\CommentEditForm;
use App\Model\CommentModel;
use App\Model\UserModel;
use App\Query\CommentQuery;
use App\Query\UserQuery;
use Core\Http\Session;

class AdminCommentController extends Controller
{
    private $validator;

    private $request;

    private $commentQuery;

    private $userQuery;

    private $commentModel;

    private $userModel;

    private $session;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->request = new Request();
        $this->commentAddForm = new CommentAddForm();
        $this->commentEditForm = new CommentEditForm();
        $this->commentQuery = new CommentQuery();
        $this->userQuery = new UserQuery();
        $this->commentModel = new CommentModel();
        $this->userModel = new UserModel();
        $this->session = new Session();
    }

    public function list()
    {

        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'approve_comment')) {
            $comments = $this->commentQuery->getComments();

            $this->render("admin/comment/listComment.phtml", ['comments'=>$comments]);
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index')->with('error','Vous n\'avez pas les droits necessaires pour accéder à cette section du back office.');
        }



    }

    public function add(){

        $form = new CommentAddForm();
        $commentAddForm = $form->getForm();

        $this->render("admin/comment/addComment.phtml", ['commentAdd'=>$commentAddForm]);
    }

    public function store()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->commentModel, $data);

            //TO CHANGE FOR DYNAMIC ARTICLE
            $data['article_id'] = '1';
            $data['user_id'] = $this->session->getSession('id');

            if(empty($errors)){
                if($this->commentQuery->create($data))
                {
                    $this->request->redirect('/admin/comment/list')->with('success', 'Le commentaire a bien été publié');
                }
                else{
                    $this->request->redirect('/admin/comment/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else {
                $form = new CommentAddForm();
                $commentAddForm = $form->getForm();
                $this->render("admin/comment/addComment.phtml", ['errors' => $errors, 'commentAdd'=>$commentAddForm]);
            }
        }
    }

    public function edit(){

        $form = new CommentEditform();
        $commentEditForm = $form->getForm();

        $this->render("admin/comment/editComment.phtml", ['commentEdit'=>$commentEditForm]);
    }

    public function update($id)
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->commentModel, $data);

            if(empty($errors)) {
                if($this->commentQuery->updateComment($data, $id)) {
                    $this->request->redirect('/admin/comment/list')->with('success', 'Le commentaire a bien été éditée');
                }
                else{
                    $this->request->redirect('/admin/comment/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else{
                $form = new CommentEditForm();
                $commentEditForm = $form->getForm();

                $this->render("admin/comment/editComment.phtml", ['errors' => $errors, 'commentEdit'=>$commentEditForm]);
            }
        }
    }

    public function delete($id)
    {
        if($this->request->isGet()) {
            if($this->commentQuery->deleteComment($id)) {
                $this->request->redirect('/admin/comment/list')->with('success', 'Le commentaires a bien été supprimé');
            } else {
                $this->request->redirect('/admin/comment/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
            }
        }
    }
}
