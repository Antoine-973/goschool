<?php
namespace App\Form;
use App\Query\PageQuery;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;

class PageEditForm
{

    public function __construct(){
        $this->request = new Request();
        $this->pageQuery = new PageQuery();
    }

    public function getForm()
    {
        $id = $this->request->getBody();

        $stringId = implode("','",$id);

        $data=$this->pageQuery->getById($stringId);

        $form = Form::create('/admin/page/edit')
                ->input('id', 'hidden', ['value' => $id['id']])
                ->input('title', 'text', ['value' => 'title', 'min' => 4, 'max' => 55, 'text' => $data['title'], 'required' => 'required'])
                ->input('url', 'text', ['value' => 'Url de la page', 'min' => 4, 'max' => 55, 'text' => $data['url'], 'required' => 'required', 'placeholder' => 'ex: /accueil'])
                ->select('status','Statut',['id' => 'status', 'name' => 'status', 'options' => ['Publié','Brouillon','Attente de validation']])
                ->textarea('content', 'textarea', ['value' => $data['content'], 'max' => 400])
                ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }

   
}