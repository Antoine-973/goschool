<?php
namespace App\Controller\Admin;

use App\Model\EventModel;
use App\Query\EventQuery;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;
use Core\Component\Validator;
use App\Form\ParamEditForm;

class AdminEventController extends Controller{

    private $request;
    private $validator;
    private $eventModel;
    private $session;

    public function __construct()
    {
        $this->request = new Request();
        $this->validator = new Validator();
        $this->eventModel = new EventModel();
        $this->session = new Session();
    }

    public function list()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'crud_event') || $id && $testPermission->has_permission($id,'crud_self_event')) {

            $eventQuery = new EventQuery();
            $events = $eventQuery->getEvents();

            $this->render("admin/event/listEvent.phtml", ['events' => $events]);
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.']);
        }
    }

    public function add(){
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'crud_event') || $id && $testPermission->has_permission($id,'crud_self_event')) {
            $this->render("admin/event/addEvent.phtml");
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.']);
        }
    }

    public function store(){
        if ($this->request->isPost()){
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->eventModel, $data);

            if (empty($errors)){
                $createQuery = new EventQuery();

                $data['user_id'] = $this->session->getSession('user_id');

                if ($createQuery->create($data)){
                    $this->request->redirect('/admin/event/list', ['flashMessage','L\'événement a bien été créer']);
                }
                else{
                    $this->request->redirect('/admin/event/list', ['flashMessage', 'Une erreur c\'est produite veuillez réessayer']);
                }
            }
            else{
                $this->render("admin/event/addEvent.phtml", ['errors' => $errors]);
            }
        }
    }

    public function edit(){
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'crud_event') || $id && $testPermission->has_permission($id,'crud_self_event')) {
            $this->render("admin/event/editEvent.phtml");
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.']);
        }
    }

    public function update(){
        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->eventModel, $data);

            if(empty($errors)) {

                $idEvent = $data['id'];
                $updateEventQuery = new EventQuery();

                if($updateEventQuery->update($data, $idEvent)) {
                    $this->request->redirect('/admin/event/list', ['flashMessage', 'L\'événement a bien été édité']);
                }
                else{
                    $this->request->redirect('/admin/event/list', ['flashMessage', 'Une erreur c\'est produite veuillez réessayer']);
                }
            }else{
                $this->render("admin/event/editEvent.phtml", ['errors' => $errors]);
            }
        }
    }

    public function delete($idEvent){
        if($this->request->isGet()) {
            $session = new Session();
            $id = $session->getSession('user_id');

            $testPermission = new \Core\Util\RolePermission();

            if ($id && $testPermission->has_permission($id, 'crud_event') || $id && $testPermission->has_permission($id,'crud_self_event')) {
                $deleteQuery = new EventQuery();

                if($deleteQuery->delete($idEvent)) {

                    $this->request->redirect('/admin/event/list', ['flashMessage', 'L\'événement a bien été supprimé']);
                }else {
                    $this->request->redirect('/admin/event/list', ['flashMessage', 'Une erreur s\'est produite veuillez réessayer']);
                }
            } else {
                $request = new \Core\Http\Request();
                $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.']);
            }
        }
    }
}