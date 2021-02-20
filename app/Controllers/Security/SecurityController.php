<?php
namespace Controller\Security;
use Core\Controller;

class SecurityController extends Controller
{

    public function __construct()
    {

    }

    public function connexion()
    {
        $this->render('connexion.php');

    }
}