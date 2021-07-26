<?php

namespace App\Controller\Admin;


use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;

class AdminNewsletterController extends Controller
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function index()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'crud_newsletter') || $id && $testPermission->has_permission($id,'crud_self_newsletter')) {
            $this->render("admin/newsletter/newsletter.phtml");
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits necessaires pour accéder à cette section du back office.']);
        }
    }
}