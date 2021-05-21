<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserInstallForm
{

    public function getForm()
    {

        $form = Form::create('/install')
                ->input('Nom de la base de données', 'text')
                ->input('Identifiant', 'text')
                ->input('Mot de passe', 'password')
                ->input('Adresse de la base de données', 'text')
                ->input('Préfixe des tables', 'text')
                ->input('Titre du site', 'text')
                ->input('Adresse email', 'text')
                ->input('Mot de passe', 'password');
        return $form->getForm();
    }
}