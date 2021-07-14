<?php
namespace App\Form;

use App\Query\MenuQuery;
use Core\Facade\Form;
use Core\Util\Table;

class SelectMenuPositionForm
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

        array_unshift($menusName , 'Aucun');


        $form = Form::create('/admin/menu/position')
            ->select('navbar', 'Navbar', ['id' => 'navbar', 'name' => 'navbar', 'options' => $menusName])
            ->select('footer', 'Footer', ['id' => 'footer', 'name' => 'footer', 'options' => $menusName])
            ->select('sidebar', 'Sidebar', ['id' => 'sidebar', 'name' => 'sidebar', 'options' => $menusName])
            ->input('submit', 'submit', ['value' => 'Editer']);
        return $form->getForm();
    }

}