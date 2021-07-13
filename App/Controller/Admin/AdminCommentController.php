<?php
namespace App\Controller\Admin;

use App\Form\CommentAddForm;
use App\Form\CommentEditForm;
use App\Model\CommentModel;
use Core\Component\Validator;
use Core\Controller;
use App\Query\CommentQuery;
use Core\Http\Request;

class AdminCommentController extends Controller
{

    private $commentQuery;
    private $request;
    private $commentModel;
    private $validator;

    public function __construct()
    {
        $this->commentQuery = new CommentQuery();
        $this->request = new Request();
        $this->commentModel = new CommentModel();
        $this->commentAddForm = new CommentAddForm();
        $this->commentEditForm = new CommentEditForm();
        $this->validator = new Validator();

    }

    public function list()
    {
        $comments = $this->commentQuery->getComments();
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
                $form = new CategoryAddForm();
                $categoryAddForm = $form->getForm();
                $this->render("admin/article/addCategory.phtml", ['errors' => $errors, 'categoryAdd'=>$categoryAddForm]);
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
