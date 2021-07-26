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
        $stringId = implode("','",$id);

        $data = $this->categoryQuery->getById($stringId);

        $categoriesNameQuery = new CategoryQuery();
        $categoriesName = $categoriesNameQuery->getCategoriesName();
        $convertTable = new Table();
        $categoriesParent = $convertTable->multi_to_single($categoriesName);
        array_unshift($categoriesParent , 'Aucune');

        $form = Form::create('/admin/category/update/'.$stringId)
            ->input('name', 'text', ['value' => 'Nom', 'text' => $data['name'], 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('slug', 'text', ['value' => 'Slug', 'text' => $data['slug'], 'min' => 4, 'max' => 55])
            ->select('categorie_parent','Catégorie Parent',['id' => 'categorie_parent', 'name' => 'categorie_parent', 'options' => $categoriesParent])
            ->textarea('description', 'textarea', ['max' => 400, 'value' => $data['description']])
            ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }
}