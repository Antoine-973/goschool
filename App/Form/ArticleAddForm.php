<?php
namespace App\Form;
use Core\Http\Session;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class ArticleAddForm
{

    public function getForm()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id,'crud_article')){
            $options = ['Publié','Brouillon','À-Valider'];
        }
        elseif($id && $testPermission->has_permission($id,'crud_self_article')){
            $options = ['Brouillon','À-Valider'];
        }


        $form = Form::create('/admin/article/store')
                ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
                ->select('status','Statut',['id' => 'status', 'name' => 'status', 'options' => $options])
                ->input('active_comment', 'checkbox', ['value' => 'Commentaire activé'])
                ->textarea('description', 'Description (Référencement)', ['max' => 160])
                ->textarea('content', 'Contenu de l\'article')
                ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }

}