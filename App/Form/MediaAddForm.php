<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class MediaAddForm
{

    public function getForm()
    {

        $form = Form::create('/admin/media/add')
            ->input('image', 'file', ['value' => 'Image'])
            ->select('roles','Role',['id' => 'roles', 'name' => 'roles', 'options' => ['admin','editeur','abonné','contributeur','auteur']])
            ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }


}