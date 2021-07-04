<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class ArticleAddForm
{

    public function getForm()
    {

        $form = Form::create('/admin/article/add')
                ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
                ->select('status','Statut',['id' => 'status', 'name' => 'status', 'options' => ['Publié','Brouillon','Attente de validation']])
                ->textarea('content', 'textarea', ['max' => 400])
                ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }

}