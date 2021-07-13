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

    public function list(){
        $categories = ($this->categoryQuery->getCategories());
        $this->render("admin/category/listCategory.phtml", ['categories'=>$categories]);
    }

    public function add(){

        $form = new CategoryAddForm();
        $categoryAddForm = $form->getForm();

        $this->render("admin/category/addCategory.phtml", ['categoryAdd'=>$categoryAddForm]);
    }

    public function store()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->categoryModel, $data);

            if(empty($errors)){
                if($this->categoryQuery->create($data))
                {
                    $this->request->redirect('/admin/category/list')->with('success', 'La catégorie a bien été créee');
                }
                else{
                    $this->request->redirect('/admin/category/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else {
                $form = new CategoryAddForm();
                $categoryAddForm = $form->getForm();
                $this->render("admin/article/addCategory.phtml", ['errors' => $errors, 'categoryAdd'=>$categoryAddForm]);
            }
        }
    }

    public function edit(){

        $form = new CategoryEditform();
        $categoryEditForm = $form->getForm();

        $this->render("admin/category/editCategory.phtml", ['categoryEdit'=>$categoryEditForm]);
    }

    public function update($id)
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->categoryModel, $data);

            if(empty($errors)) {
                if($this->categoryQuery->updateCategory($data, $id)) {
                    $this->request->redirect('/admin/category/list')->with('success', 'La catégorie a bien été éditée');
                }
                else{
                    $this->request->redirect('/admin/category/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else{
                $form = new CategoryEditForm();
                $categoryEditForm = $form->getForm();

                $this->render("admin/user/editCategory.phtml", ['errors' => $errors, 'categoryEdit'=>$categoryEditForm]);
            }
        }
    }

    public function delete($id)
    {
        if($this->request->isGet()) {
            if($this->categoryQuery->deleteCategory($id)) {
                $this->request->redirect('/admin/category/list')->with('success', 'La catégorie a bien été supprimé');
            } else {
                $this->request->redirect('/admin/category/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
            }
        } else {
            $this->request->redirect('/admin/category/list')->with('error', 'Une erreur c\'est produite veuillez réessayer');
        }
    }

}
