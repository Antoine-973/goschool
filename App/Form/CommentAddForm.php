<?php
namespace App\Form;
use App\Query\ArticleQuery;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;
use Core\Util\Table;


class CommentAddForm
{

    public function getForm()
    {
        $articlesNameQuery = new ArticleQuery();
        $articlesName = $articlesNameQuery->getArticlesName();
        $convertTable = new Table();
        $articles = $convertTable->multi_to_single($articlesName);

        $form = Form::create('/admin/comment/add')
            ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->textarea('message', 'textarea', ['min' => 3, 'max' => 280, 'required' => 'required'])
            ->select('article','Article',['id' => 'article', 'name' => 'article', 'options' => $articles])
            ->select('status','Statut',['id' => 'status', 'name' => 'status', 'options' => ['Publié','Non publié']])
            ->input('submit', 'submit', ['value' => 'Poster']);
        return $form->getForm();
    }

}