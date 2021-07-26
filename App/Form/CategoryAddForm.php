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
        $categoriesParent = $convertTable->multi_to_single($categoriesName);
        array_unshift($categoriesParent , 'Aucune');

        $form = Form::create('/admin/category/store')
            ->input('name', 'text', ['value' => 'Nom', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->select('categorie_parent','Catégorie Parent',['id' => 'categorie_parent', 'name' => 'categorie_parent', 'options' => $categoriesParent])
            ->textarea('description', 'textarea', ['max' => 400])
            ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }

}