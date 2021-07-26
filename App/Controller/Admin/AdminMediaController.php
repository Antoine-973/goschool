<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Form\MediaAddForm;
use Core\Http\Session;

class AdminMediaController extends Controller{

    private $request;

    private $response;

    private $mediaAddForm;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->mediaAddForm = new MediaAddForm();
    }

    public function list()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id,'crud_media') || $id && $testPermission->has_permission($id,'crud_self_media') ){

            $repertoire='medias/';/* chemin du repertoire */
            /* ouverture du dossier */
            $chemin_fichiers = opendir($repertoire);
            /* initialisation tableau des noms */
            $name_fichiers= [];
            while($fichier = readdir($chemin_fichiers))
            {
                if(!is_dir($fichier))
                {
                    array_push($name_fichiers, $fichier);/* ajout au tableau */
                }
            }
            closedir();
            /* nombre d'images récupérées */
            $nb_total_img=count($name_fichiers);
            //var_dump($name_fichiers);
            $listMedias = $name_fichiers;
            $this->render("admin/media/listMedia.phtml", ['listMedias'=>$listMedias, 'nb_total_img'=>$nb_total_img, 'repertoire'=>$repertoire]);
        }
        else{
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.']);
        }
    }

    public function add()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id,'crud_media') || $id && $testPermission->has_permission($id,'crud_self_media') ){
            $form = new MediaAddForm();
            $mediaAddForm = $form->getForm();

            $this->render("admin/media/addMedia.phtml", ['mediaAddForm'=>$mediaAddForm]);
        }else{
            $request = new \Core\Http\Request();
            $request->redirect('/admin/media/list', ['flashMessage','Vous n\'avez pas les droits nécessaires pour ajouter des médias.']);
        }
    }


    public function store()
    {
        var_dump($_FILES['image']['size']);
        if($this->request->isPost()) {
            if($_FILES['image']['size'] <= 1000000) {
                $fileInfos = pathinfo($_FILES['image']['name']);
                $fileExtension = $fileInfos['extension'];
                $extensionsOk = ['jpg', 'jpeg', 'svg', 'png', 'gif'];
                if(in_array($fileExtension, $extensionsOk)) {
                    move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.basename($_FILES['image']['name']));
                    $this->request->redirect('/admin/media/list', ['flashMessage','Le média a été ajouté avec succès !']);
                } else {
                    $this->request->redirect('/admin/media/add', ['flashMessage','Cette extension de fichiers n\'est pas pris en compte.'] );
                }
            } else {
                $this->request->redirect('/admin/media/add', ['flashMessage','Le fichier est trop volumineux.']);
            }
        }
    }

    public function delete()
    {
        if($this->request->isGet()) {
            $session = new Session();
            $id = $session->getSession('user_id');

            $testPermission = new \Core\Util\RolePermission();

            if ($id && $testPermission->has_permission($id,'crud_media')){
                $image = $_GET['name'];
                $open = opendir("../images");
                if($this->request->isGet()) {
                    unlink("../images/".$image);
                    closedir($open);
                    $this->request->redirect('/admin/media/list');
                } else {
                    closedir($open);
                    $this->request->redirect('/admin/media/list');
                }
            }
            else{
                $request = new \Core\Http\Request();
                $request->redirect('/admin/media/list', ['flashMessage','Vous n\'avez pas les droits nécessaires pour supprimer des médias.']);
            }
        }
    }
}