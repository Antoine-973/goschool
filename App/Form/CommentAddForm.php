<?php
namespace App\Form;
use App\Query\ArticleQuery;
use App\Query\UserQuery;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;
use Core\Util\Table;


class CommentAddForm
{

    public function getForm()
    {
        $articlesSlugQuery = new ArticleQuery();
        $articlesSlug = $articlesSlugQuery->getArticlesSlug();
        $convertTable = new Table();
        $articles = $convertTable->multi_to_single($articlesSlug);

        $usersMailQuery = new UserQuery();
        $usersMail = $usersMailQuery->getUsersMail();
        $convertTable = new Table();
        $users = $convertTable->multi_to_single($usersMail);

        $form = Form::create('/admin/comment/store')
            ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->textarea('message', 'textarea', ['min' => 3, 'max' => 280, 'required' => 'required'])
            ->select('article','Article',['id' => 'article', 'name' => 'article', 'options' => $articles])
            ->select('user','Utilisateur',['id' => 'user', 'name' => 'user', 'options' => $users])
            ->select('status','Statut',['id' => 'status', 'name' => 'status', 'options' => ['Publié','Non']])
            ->input('submit', 'submit', ['value' => 'Poster']);
        return $form->getForm();
    }

}