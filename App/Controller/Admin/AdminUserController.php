<?php
namespace App\Controller\Admin;

use Core\Controller;

class AdminUserController extends Controller {

    public function indexUserManager()
    {
        $this->render("admin/user/userManager.phtml");
    }
}