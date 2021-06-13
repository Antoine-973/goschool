<?php
namespace App\Form;
use App\Query\ArticleQuery;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;

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

        $form = Form::create('/admin/article/edit')
                ->input('id', 'hidden', ['value' => $id['id']])
                ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
                ->textarea('content', 'textarea', ['value' => $data['content'], 'max' => 400])
                ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }

   
}