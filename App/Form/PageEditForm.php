<?php
namespace App\Form;
use App\Query\PageQuery;
use Core\Http\Session;
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
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id,'crud_page')){
            $options = ['Publié','Brouillon','À-Valider'];
        }
        elseif($id && $testPermission->has_permission($id,'crud_self_page')){
            $options = ['Brouillon','À-Valider'];
        }

        $pageId = $this->request->getBody();

        $stringId = implode("','",$pageId);

        $data=$this->pageQuery->getById($stringId);

        $form = Form::create('/admin/page/update/'. $stringId)
                ->input('title', 'text', ['value' => 'title', 'min' => 4, 'max' => 55, 'text' => $data['title'], 'required' => 'required'])
                ->input('url', 'text', ['value' => 'Url de la page', 'min' => 4, 'max' => 55, 'text' => $data['url'], 'required' => 'required', 'placeholder' => 'ex: /accueil'])
                ->select('status','Statut',['id' => 'status', 'name' => 'status', 'options' => $options])
                ->textarea('content', 'textarea', ['value' => $data['content'], 'max' => 400])
                ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }

   
}