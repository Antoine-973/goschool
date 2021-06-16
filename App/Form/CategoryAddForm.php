<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class CategoryAddForm
{

    public function getForm()
    {

        $form = Form::create('/admin/categorie/add')
            ->input('name', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('slug', 'text', ['value' => 'Slug', 'min' => 4, 'max' => 55])
            ->select('categorie_parent','Catégorie Parent',['id' => 'categorie_parent', 'name' => 'categorie_parent', 'options' => ['Aucune', 'Non classé']])
            ->textarea('description', 'textarea', ['max' => 400])
            ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }

}