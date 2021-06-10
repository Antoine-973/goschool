<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;
use Core\Http\Response;
use Core\Component\Validator;

class AdminMediaController extends Controller{

    private $request;

    private $response;

    private $validator;

    private $session;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function index()
    {
        $listMedias = "/librairies/images/admin/logo.svg";
        $this->render("admin/medias/list.phtml", ['listMedias'=>$listMedias]);
    }
}