<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class PageAddForm
{

    public function getForm()
    {

        $form = Form::create('/admin/page/add')
                ->input('title', 'text', ['value' => 'Titre de la page', 'min' => 4, 'max' => 55, 'required' => 'required', 'placeholder' => 'ex: accueil'])
                ->input('url', 'text', ['value' => 'Url de la page', 'min' => 4, 'max' => 55, 'required' => 'required', 'placeholder' => 'ex: /accueil'])
                ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }

}