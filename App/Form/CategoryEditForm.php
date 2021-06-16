<?php
namespace App\Form;

use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;

class CategoryEditForm
{

    private $request;

    public function __construct(){
        $this->request = new Request();
    }

    public function getForm()
    {
        $id = $this->request->getBody();

        $form = Form::create('/admin/categorie/edit')
            ->input('id', 'hidden', ['value' => $id['id']])
            ->input('name', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('slug', 'text', ['value' => 'Slug', 'min' => 4, 'max' => 55])
            ->select('categorie_parent','Catégorie Parent',['id' => 'categorie_parent', 'name' => 'categorie_parent', 'options' => ['Aucune', 'Non classé']])
            ->textarea('description', 'textarea', ['max' => 400])
            ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }
}