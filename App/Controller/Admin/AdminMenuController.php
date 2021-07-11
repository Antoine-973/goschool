<?php


namespace App\Controller\Admin;


use App\Form\SelectMenuForm;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;

class AdminMenuController extends Controller
{
    private $request;

    private $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function indexSelectMenu()
    {
        $form = new SelectMenuForm();
        $selectMenuForm = $form->getForm();

        $this->render("admin/menu/menu.phtml", ['selectMenu' => $selectMenuForm]);
    }
}