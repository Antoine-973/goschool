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

    public function indexAddCategory(){

        $form = new CategoryAddForm();
        $categoryAddForm = $form->getForm();

        $this->render("admin/category/addCategory.phtml", ['categoryAdd'=>$categoryAddForm]);
    }

    public function addCategory()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->categoryModel, $data);

            if(empty($errors)){
                if($this->categoryQuery->create($data))
                {
                    $this->request->redirect('/admin/categories')->with('success', 'La catégorie a bien été créee');
                }
                else{
                    $this->request->redirect('/admin/categories')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else {
                $form = new CategoryAddForm();
                $categoryAddForm = $form->getForm();
                $this->render("admin/article/addCategory.phtml", ['errors' => $errors, 'categoryAdd'=>$categoryAddForm]);
            }
        }
    }

    public function indexEditCategory(){

        $form = new CategoryEditform();
        $categoryEditForm = $form->getForm();

        $this->render("admin/category/editCategory.phtml", ['categoryEdit'=>$categoryEditForm]);
    }

    public function editCategory()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $id = $data['id'];
            $dataToUpdate = array_slice($data, 1);
            $errors = $this->validator->validate($this->categoryModel, $dataToUpdate);

            if(empty($errors)) {
                if($this->categoryQuery->updateCategory($dataToUpdate, $id)) {
                    $this->request->redirect('/admin/categories')->with('success', 'La catégorie a bien été éditée');
                }
                else{
                    $this->request->redirect('/admin/categories')->with('error', 'Une erreur c\'est produite veuillez réessayer');
                }
            }
            else{
                $form = new CategoryEditForm();
                $categoryEditForm = $form->getForm();

                $this->render("admin/user/editCategory.phtml", ['errors' => $errors, 'categoryEdit'=>$categoryEditForm]);
            }
        }
    }

    public function deleteCategory()
    {
        $id = $_GET['id'];
        if($this->request->isGet()) {
            if($this->categoryQuery->deleteCategory($id)) {
                $this->request->redirect('/admin/categories')->with('success', 'La catégorie a bien été supprimé');
            } else {
                $this->request->redirect('/admin/categories')->with('error', 'Une erreur c\'est produite veuillez réessayer');
            }
        } else {
            $this->request->redirect('/admin/categories')->with('error', 'Une erreur c\'est produite veuillez réessayer');
        }
    }

}
