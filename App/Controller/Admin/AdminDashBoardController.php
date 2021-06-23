<?php
namespace App\Controller\Admin;

use Core\Controller;

class AdminDashBoardController extends Controller{

    public function index(){
        $this->render('admin/index.phtml');
    }
}