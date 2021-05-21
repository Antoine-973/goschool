<?php
namespace App\Controller\Admin;

use Core\Controller;

class DashBoardController extends Controller{

    public function index(){
        $this->render('admin/index.phtml');
    }
}