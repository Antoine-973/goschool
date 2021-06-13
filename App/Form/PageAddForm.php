<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class PageAddForm
{

    public function getForm()
    {

        $form = Form::create('/admin/page/add')
                ->input('title', 'text', ['value' => 'Titre', 'min' => 4, 'max' => 55, 'required' => 'required'])
                ->textarea('content', 'textarea', ['max' => 400])
                ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }

}