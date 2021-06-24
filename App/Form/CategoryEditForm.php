<?php
namespace App\Form;

use App\Query\CategoryQuery;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;
use Core\Util\Table;

class CategoryEditForm
{

    private $request;
    private $categoryQuery;

    public function __construct(){
        $this->request = new Request();
        $this->categoryQuery =new CategoryQuery();
    }

    public function getForm()
    {
        $id = $this->request->getBody();
        $categoriesName = $this->categoryQuery->getCategoriesName();
        $convertTable = new Table();
        $data = $convertTable->multi_to_single($categoriesName);
        array_unshift($data , 'Aucune');

        $form = Form::create('/admin/categorie/edit')
            ->input('id', 'hidden', ['value' => $id['id']])
            ->input('name', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('slug', 'text', ['value' => 'Slug', 'min' => 4, 'max' => 55])
            ->select('categorie_parent','Catégorie Parent',['id' => 'categorie_parent', 'name' => 'categorie_parent', 'options' => $data])
            ->textarea('description', 'textarea', ['max' => 400])
            ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }
}