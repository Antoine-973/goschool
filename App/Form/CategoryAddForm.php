<?php
namespace App\Form;
use App\Query\CategoryQuery;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Util\Table;


class CategoryAddForm
{
    private $categoryQuery;

    public function __construct(){
        $this->categoryQuery =new CategoryQuery();
    }

    public function getForm()
    {
        $categoriesName = $this->categoryQuery->getCategoriesName();
        $convertTable = new Table();
        $data = $convertTable->multi_to_single($categoriesName);
        array_unshift($data , 'Aucune');

        $form = Form::create('/admin/categorie/add')
            ->input('name', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('slug', 'text', ['value' => 'Slug', 'min' => 4, 'max' => 55])
            ->select('categorie_parent','Catégorie Parent',['id' => 'categorie_parent', 'name' => 'categorie_parent', 'options' => $data])
            ->textarea('description', 'textarea', ['max' => 400])
            ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }

}