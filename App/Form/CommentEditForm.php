<?php
namespace App\Form;

use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;

class CommentEditForm
{

    private $request;

    public function __construct(){
        $this->request = new Request();
    }

    public function getForm()
    {
        $id = $this->request->getBody();

        $form = Form::create('/admin/comment/edit')
            ->input('id', 'hidden', ['value' => $id['id']])
            ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->textarea('message', 'textarea', ['min' => 3, 'max' => 280, 'required' => 'required'])
            ->select('statut','Statut',['id' => 'statut', 'name' => 'statut', 'options' => ['Approuvé','En attente','Spam']])
            ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }


}