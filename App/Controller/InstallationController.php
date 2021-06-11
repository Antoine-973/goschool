<?php
namespace App\Controller;
use Core\Controller;
use Core\Util\DotEnv;

class InstallationController extends Controller
{
    public function index()
    {
        $this->view("install.phtml");
    }
}