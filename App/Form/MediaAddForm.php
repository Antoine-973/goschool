<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class MediaAddForm
{
    public function getForm()
    {

        $form = Form::create('/admin/media/store')
            ->input('image', 'file', ['value' => 'Image'])
            ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }


}
