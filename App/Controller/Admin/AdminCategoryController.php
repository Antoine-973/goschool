<?php
namespace App\Controller\Admin;

use App\Form\CategoryAddForm;
use App\Form\CategoryEditForm;
use App\Model\CategoryModel;
use App\Query\CategoryQuery;
use Core\Component\Validator;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;

class AdminCategoryController extends Controller {

    private $request;

    private $validator;

    private $response;

    private $categoryModel;

    private $categoryAddForm;

    private $categoryEditForm;

    private $categoryQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->categoryModel = new CategoryModel();
        $this->categoryAddForm = new CategoryAddForm();
        $this->categoryEditForm = new CategoryEditForm();
        $this->categoryQuery = new CategoryQuery();
        $this->categoryModel = new CategoryModel();
        $this->validator = new Validator();

    }

    public function indexListCategory(){
        $categories = ($this->categoryQuery->getCategories());
        $this->render("admin/category/listCategory.phtml", ['categories'=>$categories]);
    }
}
