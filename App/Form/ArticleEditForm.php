<?php
namespace App\Form;
use App\Query\ArticleQuery;
use App\Query\CategoryQuery;
use Core\Http\Session;
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
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id,'crud_article')){
            $options = ['Publié','Brouillon','À-Valider'];
        }
        elseif($id && $testPermission->has_permission($id,'crud_self_article')){
            $options = ['Brouillon','À-Valider'];
        }

        $articleId = $this->request->getBody();
  

        $stringId = implode("','",$articleId);

        $data=$this->articleQuery->getById($stringId);

        $categoriesNameQuery = new CategoryQuery();
        $categoriesName = $categoriesNameQuery->getCategoriesName();
        $convertTable = new Table();
        $categories = $convertTable->multi_to_single($categoriesName);

        $form = Form::create('/admin/article/update/'.$articleId['id'])
                ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'text' => $data['title'], 'required' => 'required'])
                ->input('slug', 'text', ['value' => 'Slug', 'min' => 4, 'max' => 55, 'text' => $data['slug'], 'required' => 'required'])
                ->select('status','Statut',['id' => 'status', 'name' => 'status', 'options' => $options])
                ->select('categorie','Catégorie',['id' => 'categorie', 'name' => 'categorie', 'options' => $categories])
                ->input('active_comment', 'checkbox', ['value' => 'Commentaire activé'])
                ->textarea('content', 'textarea', ['value' => $data['content']])
                ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }

   
}