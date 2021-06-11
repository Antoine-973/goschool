<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Model\PageModel;
use App\Query\PageQuery;
use Core\Component\Validator;

class AdminPageController extends Controller {

    private $validator;

    private $request;

    private $response;

    private $pageModel;

    private $pageQuery;


    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->pageModel = new PageModel();
        $this->pageQuery = new PageQuery();
        $this->validator = new Validator();
    }

    public function indexPageManager()
    {
        $pages = $this->pageQuery->getPages();
        $this->render("admin/page/pageManager.phtml", ['pages'=>$pages]);
    }

    public function indexAddPage()
    {
        $pages = $this->pageQuery->getPages();
        $this->render("admin/page/addPage.phtml");
    }

    public function indexEditPage()
    {
        $pages = $this->pageQuery->getPages();
        $this->render("admin/page/editPage.phtml");
    }

}