<?php
namespace Controller\Admin;
use Core\Controller;

class AdminConnexionController extends Controller{

    public function __construct(){

    }

    public function index(){
        $this->render('connexion.php');
        
    }
}