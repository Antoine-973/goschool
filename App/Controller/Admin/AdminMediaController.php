<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Form\MediaAddForm;

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
        $repertoire='../images/';/* chemin du repertoire */
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

    public function add()
    {
        $form = new MediaAddForm();
        $mediaAddForm = $form->getForm();

        $this->render("admin/media/addMedia.phtml", ['mediaAddForm'=>$mediaAddForm]);
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
                    $this->request->redirect('/admin/media/list');
                } else {
                    $this->request->redirect('/admin/media/add');
                }
            } else {
                $this->request->redirect('/admin/media/add');
            }
        } else {
            $this->request->redirect('/admin/media/add');
        }
    }

    public function delete()
    {
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
}