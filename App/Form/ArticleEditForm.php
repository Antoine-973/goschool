<?php
namespace App\Form;
use App\Query\ArticleQuery;
use App\Query\CategoryQuery;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;
use Core\Util\Table;

class ArticleEditForm
{

    public function __construct(){
        $this->request = new Request();
        $this->articleQuery = new ArticleQuery();
    }

    public function getForm()
    {
        $id = $this->request->getBody();

        $stringId = implode("','",$id);

        $data=$this->articleQuery->getById($stringId);

        $categoriesNameQuery = new CategoryQuery();
        $categoriesName = $categoriesNameQuery->getCategoriesName();
        $convertTable = new Table();
        $categories = $convertTable->multi_to_single($categoriesName);

        $form = Form::create('/admin/article/edit')
                ->input('id', 'hidden', ['value' => $id['id']])
                ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'text' => $data['title'], 'required' => 'required'])
                ->input('slug', 'text', ['value' => 'Slug', 'min' => 4, 'max' => 55, 'text' => $data['slug'], 'required' => 'required'])
                ->select('status','Statut',['id' => 'status', 'name' => 'status', 'options' => ['Publié','Brouillon','Attente de validation']])
                ->select('categorie','Catégorie',['id' => 'categorie', 'name' => 'categorie', 'options' => $categories])
                ->input('active_comment', 'checkbox', ['value' => 'Commentaire activé'])
                ->textarea('content', 'textarea', ['value' => $data['content']])
                ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }

   
}