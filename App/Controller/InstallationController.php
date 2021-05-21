<?php
namespace App\Controller;
use Core\Controller;

class InstallationController extends Controller
{
    public function index()
    {
        $this->render("install.phtml");
    }

    public function handleInstallation()
    {
        
    }
}