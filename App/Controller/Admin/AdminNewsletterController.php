<?php

namespace App\Controller\Admin;


use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;

class AdminNewsletterController extends Controller
{
    private $request;

    private $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function indexNewsletter()
    {
        $this->render("admin/newsletter/newsletter.phtml");
    }
}