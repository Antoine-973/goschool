<?php
namespace App\Controller;
use Core\Controller;

class HomeController extends Controller{

    public function index(){

        return $this->render("site/pages/sample_page.phtml");
    }

    public function article(){
        $request = new Request();
        $path = $request->getPath();
        $arr = explode('/', $path);

        if (count($arr) == '3'){
            return $this->render("site/pages/sample_page.phtml");
        }
    }
}