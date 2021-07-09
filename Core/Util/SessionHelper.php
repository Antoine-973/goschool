<?php


namespace Core\Util;

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
        if($this->session->getSession('id')){

        }
        else{
            $request = new Request();
            $request->redirect('/admin/login')->with('error','Vous devez être connecté pour accéder à cette page !');
        }
    }

    public function redirectToDashboardIfAlreadyLogged(){
        if($this->session->getSession('id')){
            $request = new Request();
            $request->redirect('/admin')->with('success','Vous êtes déjà connecté !');
        }
        else{

        }
    }
}