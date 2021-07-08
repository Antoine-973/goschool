<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use App\Query\UserQuery;
use Core\Util\Table;


class MediaAddForm
{
    private $userQuery;

    public function __construct()
    {
        $this->userQuery = new UserQuery();
    }

    public function getForm()
    {
        $roles = $this->userQuery->getRole();
        $convertTable = new Table();
        $data = $convertTable->multi_to_single($roles);
        array_unshift($data , 'Aucun');

        $form = Form::create('/admin/media/add')
            ->input('image', 'file', ['value' => 'Image'])
            ->input('submit', 'submit', ['value' => 'Ajouter']);
        return $form->getForm();
    }


}