<?php
namespace App\Controller;
use Core\Controller;

class PageController  extends Controller{

    public function index()
    {
        $this->getPage();
    }
}