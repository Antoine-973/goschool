<?php
namespace App\Form;

use App\Query\MenuQuery;
use Core\Facade\Form;
use Core\Util\Table;

class SelectMenuForm
{
    private $menuQuery;

    public function __construct()
    {
        $this->menuQuery = new MenuQuery();
    }

    public function getForm()
    {
        $menusName = $this->menuQuery->getMenusName();
        $convertTable = new Table();
        if (empty($menusName)){

        }
        elseif ($convertTable->is_multi($menusName)){
            $menusName = $convertTable->multi_to_single($menusName);
        }

        $form = Form::create('/admin/menu/select')
            ->select('name', 'Nom', ['id' => 'name', 'name' => 'name', 'options' => $menusName])
            ->input('submit', 'submit', ['value' => 'Editer']);
        return $form->getForm();
    }

}