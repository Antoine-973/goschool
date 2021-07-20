<?php
namespace App\Form;
use Core\Http\Session;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class PageAddForm
{

    public function getForm()
    {

        $session = new Session();
        $id = $session->getMessage('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id,'crud_page')){
            $options = ['Publié','Brouillon','À-Valider'];
        }
        elseif($id && $testPermission->has_permission($id,'crud_self_page')){
            $options = ['Brouillon','À-Valider'];
        }

        $form = Form::create('/admin/page/store')
                ->input('title', 'text', ['value' => 'Titre de la page', 'min' => 4, 'max' => 55, 'required' => 'required', 'placeholder' => 'ex: accueil'])
                ->input('url', 'text', ['value' => 'Url de la page', 'min' => 4, 'max' => 55, 'required' => 'required', 'placeholder' => 'ex: /accueil'])
                ->select('status','Statut',['id' => 'status', 'name' => 'status', 'options' => $options])
                ->textarea('content', 'textarea', ['max' => 400])
                ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }

}