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

class AdminCommentController extends Controller
{
    private $validator;

    private $request;

    private $commentQuery;

    private $userQuery;

    private $commentModel;

    private $userModel;

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

    }

    public function list()
    {
        $comments = $this->commentQuery->getComments();
        $countComments = count($comments);

        for($y = 0; $y < $countComments; $y++) {
            $userId = $comments[$y]['user_id'];
            $userQuery = new UserQuery();
            $userEmail = $userQuery->getEmailById($userId);
            $value = array_shift($userEmail);
            $comments[$y]['user_id'] = $value;
        }
        $this->render("admin/comment/listComment.phtml", ['comments'=>$comments]);
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

            if(empty($errors)){
                if($this->commentQuery->create($data))
                {
                    $this->request->redirect('/admin/comment/list')->with('success', 'La catégorie a bien été créee');
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

                $this->render("admin/comment/editComment.phtml", ['errors' => $errors, 'categoryEdit'=>$commentEditForm]);
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
