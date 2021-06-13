<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class ArticleAddForm
{

    public function getForm()
    {
        $article = [
            'title' => 'hello world',
            'content' => 'lorem ipsum'
    
    ];
        $form = Form::create('/admin/article/add')
                ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required', 'text' => $article['title']])
                ->textarea('content', 'textarea', ['max' => 400])
                ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }

}