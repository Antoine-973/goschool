<?php
namespace App\Controller;
use Core\Controller;

class InstallationController extends Controller
{
    public function index()
    {
        $this->view("install.phtml");
    }

    public function handleInstallation()
    {
        $user_data = [];
        $db_data = [];
    }
}