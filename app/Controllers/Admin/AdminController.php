<?php
namespace Controller\Admin;
use Core\Controller;

class AdminController extends Controller{

    public function __construct(){

    }

    public function index(){
        $this->render('dashboard.php');
        
    }
}