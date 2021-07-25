<?php


namespace App\Controller;


class ErrorController extends \Core\Controller
{
    public function error404(){
        return $this->render("errors/404.phtml");
    }

    public function error403(){

        return $this->render("errors/403.phtml");
    }

    public function error500(){

        return $this->render("errors/pages/500.phtml");
    }
}