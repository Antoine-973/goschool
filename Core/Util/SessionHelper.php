<?php


namespace Core\Util;

use App\Query\UserQuery;
use Core\Http\Request;
use Core\Http\Session;

class SessionHelper
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function redirectToLoginIfNotConnected(){

        $id = $this->session->getMessage('id');

        if(!empty($id)){
            $roleQuery = new UserQuery();
            $role = $roleQuery->getRoleById($id)['roles'];

            if ($role == 'admin' || $role == 'editeur' || $role == 'contributeur' || $role == 'auteur'){

            }
            else{
                $request = new Request();
                $request->redirect('/admin/auth/forbidden')->with('error','Vous devez être Administrateur pour accéder à cette page !');
            }
        }
        else{
            $request = new Request();
            $request->redirect('/admin/auth/login')->with('error','Vous devez être connecté pour accéder à cette page !');
        }
    }

    public function redirectToDashboardIfAlreadyLogged(){

        $id = $this->session->getMessage('user_id');
        $testPermission = new RolePermission();

        if($id && $testPermission->has_permission($id,'access_back_office')){
                $request = new Request();
                $request->redirect('/admin/dashboard/index')->with('success','Vous êtes déjà connecté !');
            }
        else{

        }
    }
}