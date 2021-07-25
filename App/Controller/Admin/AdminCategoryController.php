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
use Core\Http\Session;

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

        $session = new Session();
        $user_id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($user_id && $testPermission->has_permission($user_id, 'crud_categorie')) {
            $categories = ($this->categoryQuery->getCategories());
            $this->render("admin/category/listCategory.phtml", ['categories'=>$categories]);
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.']);
        }
    }

    public function add(){
        $session = new Session();
        $user_id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($user_id && $testPermission->has_permission($user_id, 'crud_categorie')) {
            $form = new CategoryAddForm();
            $categoryAddForm = $form->getForm();

            $this->render("admin/category/addCategory.phtml", ['categoryAdd'=>$categoryAddForm]);
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour ajouter des catégories.']);
        }
    }

    public function store()
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->categoryModel, $data);

            if(empty($errors)){
                if($this->categoryQuery->create($data))
                {
                    $this->request->redirect('/admin/category/list', ['flashMessage', 'La catégorie a bien été créee']);
                }
                else{
                    $this->request->redirect('/admin/category/list', ['flashMessage', 'Une erreur c\'est produite veuillez réessayer']);
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
        $session = new Session();
        $user_id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($user_id && $testPermission->has_permission($user_id, 'crud_categorie')) {
            $form = new CategoryEditform();
            $categoryEditForm = $form->getForm();

            $this->render("admin/category/editCategory.phtml", ['categoryEdit'=>$categoryEditForm]);
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour éditer cette catégorie.']);
        }
    }

    public function update($id)
    {
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->categoryModel, $data);

            if(empty($errors)) {
                if($this->categoryQuery->updateCategory($data, $id)) {
                    $this->request->redirect('/admin/category/list', ['flashMessage', 'La catégorie a bien été éditée']);
                }
                else{
                    $this->request->redirect('/admin/category/list', ['flashMessage', 'Une erreur c\'est produite veuillez réessayer']);
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
            $session = new Session();
            $user_id = $session->getSession('user_id');

            $testPermission = new \Core\Util\RolePermission();

            if ($user_id && $testPermission->has_permission($user_id, 'crud_categorie')) {
                if($this->categoryQuery->deleteCategory($id)) {
                    $this->request->redirect('/admin/category/list', ['flashMessage', 'La catégorie a bien été supprimé']);
                } else {
                    $this->request->redirect('/admin/category/list', ['flashMessage', 'Une erreur c\'est produite veuillez réessayer']);
                }
            } else {
                $request = new \Core\Http\Request();
                $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour supprimer cette catégorie.']);
            }
        }
    }

}
