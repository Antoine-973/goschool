<?php


namespace App\Controller\Admin;


use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;

class AdminCustomizationController extends Controller
{
    private $request;

    private $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function indexCustomization()
    {
        $this->render("admin/customization/customization.phtml");
    }
}