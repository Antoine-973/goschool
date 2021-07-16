<?php

namespace App\Controller\Admin;


use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use Core\Http\Session;

class AdminNewsletterController extends Controller
{
    private $request;

    private $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function index()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'manage_newsletter')) {
            $this->render("admin/newsletter/newsletter.phtml");
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index')->with('error','Vous n\'avez pas les droits necessaires pour accéder à cette section du back office.');
        }
    }
}