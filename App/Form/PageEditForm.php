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
                ->input('title', 'text', ['value' => 'title', 'min' => 4, 'max' => 55, 'required' => 'required'])
                ->textarea('content', 'textarea', ['value' => $data['content'], 'max' => 400])
                ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }

   
}