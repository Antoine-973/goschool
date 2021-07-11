<?php
namespace App\Form;

use App\Query\MenuQuery;
use Core\Facade\Form;
use Core\Http\Request;

class MenuEditForm
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->menuQuery = new MenuQuery();
    }

    public function getForm()
    {
        $id = $this->request->getBody();

        $form = Form::create('/admin/menu/edit')
            ->input('submit', 'submit', ['value' => 'Editer']);
        return $form->getForm();
    }
}