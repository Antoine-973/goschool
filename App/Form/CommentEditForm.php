<?php
namespace App\Form;

use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;
use App\Query\CommentQuery;

class CommentEditForm
{

    private $request;
    private $commentQuery;

    public function __construct(){
        $this->request = new Request();
        $this->commentQuery = new CommentQuery();
    }

    public function getForm()
    {
        $id = $this->request->getBody();
        $stringId = implode("','",$id);

        $data=$this->commentQuery->getById($stringId);

        $form = Form::create('/admin/comment/update/'.$stringId)
            ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'text' => $data['title'], 'required' => 'required'])
            ->textarea('message', 'textarea', ['min' => 3, 'max' => 280, 'value' => $data['message'], 'required' => 'required'])
            ->select('status','Statut',['id' => 'status', 'name' => 'status', 'text' => $data['status'], 'options' => ['Approuvé','En-attente','Spam']])
            ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }


}