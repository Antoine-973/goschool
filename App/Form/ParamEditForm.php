<?php
namespace App\Form;

use App\Query\ParamQuery;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;
use Core\Http\Request;
use Core\Util\Table;

class ParamEditForm
{

    private $request;
    private $paramQuery;

    public function __construct(){
        $this->request = new Request();
        $this->paramQuery =new ParamQuery();
    }

    public function getForm()
    {
        $form = Form::create('/admin/param')
            ->input('site_name', 'text', ['value' => 'Nom du site', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->input('url', 'text', ['value' => 'URL', 'min' => 4, 'max' => 55, 'required' => 'required'])
            ->select('visible','Visibilité',['id' => 'visible', 'name' => 'visible', 'options' => ['Publique','Privée']])
            ->input('default_role', 'radio', ['value' => 'Définir un rôle par défaut'])
            ->select('name_role','Role',['id' => 'role', 'name' => 'role', 'options' => ['Admin','Eleve']])
            ->textarea('description', 'Description', ['max' => 400])
            ->input('lang', 'radio', ['value' => 'Langue'])
            ->input('save', 'radio', ['value' => 'Sauvegarde automatique'])
            ->input('update', 'radio', ['value' => 'Mise à jour automatique'])
            ->input('submit', 'submit', ['value' => 'Modifier']);
        return $form->getForm();
    }
}