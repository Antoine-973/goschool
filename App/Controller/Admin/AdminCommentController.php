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

    public function indexListComment()
    {
        $comments = $this->commentQuery->getComments(); // Récupération de tout les commentaires.
        $countComments = count($comments); // Compter le nombre total de commentaire.

        for($y = 0; $y < $countComments; $y++) { // Change la valeur de user_id dans le tableau par le mail de l'user.
            $userId = $comments[$y]['user_id'];
            $userQuery = new UserQuery();
            $userEmail = $userQuery->getEmailById($userId);
            $value = array_shift($userEmail); // Dépile l'élément qu'on a obtenu de getEmailById.
            $comments[$y]['user_id'] = $value;
        }
        $this->render("admin/comment/listComment.phtml", ['comments'=>$comments]); // Retourne à la view la liste de commentaire.
    }

    public function indexAddComment()
    {
        $form = new CommentAddForm();
        $commentAddForm = $form->getForm();
        
        $this->render("admin/comment/addComment.phtml", ['commentAdd'=>$commentAddForm]);
    }

    public function addComment()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->commentModel, $data);

            if(empty($errors)){
                if($this->commentQuery->create($data))
                {
                    $this->request->redirect('/admin/comments')->with('success', 'Le commentaire bien été créee');
                }
                else{
                    $this->request->redirect('/admin/comments')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else {
                $form = new CommentAddForm();
                $commentAddForm = $form->getForm();
                $this->render("admin/comment/addComment.phtml", ['errors' => $errors, 'commentAdd'=>$commentAddForm]);
            }
        }
    }

    public function indexEditComment(){

        $form = new CommentEditform();
        $commentEditForm = $form->getForm();

        $this->render("admin/comment/editComment.phtml", ['commentEdit'=>$commentEditForm]);
    }

    public function editComment()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $id = $data['id'];
            $dataToUpdate = array_slice($data, 1);
            $errors = $this->validator->validate($this->commentModel, $dataToUpdate);

            if(empty($errors)) {
                if($this->commentQuery->updateComment($dataToUpdate, $id)) {
                    $this->request->redirect('/admin/comments')->with('success', 'Le commentaire a bien été éditée');
                }
                else{
                    $this->request->redirect('/admin/comments')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else{
                $form = new CommentEditForm();
                $commentEditForm = $form->getForm();

                $this->render("admin/comment/editComment.phtml", ['errors' => $errors, 'categoryEdit'=>$commentEditForm]);
            }
        }
    }

    public function deleteComment()
    {
        $id = $_GET['id'];
        if($this->request->isGet()) {
            if($this->commentQuery->deleteComment($id)) {
                $this->request->redirect('/admin/comments')->with('success', 'Le commentaires a bien été supprimé');
            } else {
                $this->request->redirect('/admin/comments')->with('error', 'Une erreur c\'est produite veuillez réessayer');
            }
        }
    }
}
