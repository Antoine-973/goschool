<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;

class AdminMediaController extends Controller{

    private $request;

    private $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function index()
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

    public function indexAddMedia()
    {
        $this->render("admin/media/addMedia.phtml");
    }

    public function addMedia()
    {
        var_dump($_FILES['image']['size']);
        if($this->request->isPost()) {
            if($_FILES['image']['size'] <= 1000000) {
                $fileInfos = pathinfo($_FILES['image']['name']);
                $fileExtension = $fileInfos['extension'];
                $extensionsOk = ['jpg', 'jpeg', 'svg', 'png'];
                if(in_array($fileExtension, $extensionsOk)) {
                    move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.basename($_FILES['image']['name']));
                    $this->request->redirect('/admin/medias');
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

    public function deleteMedia()
    {
        $image = $_GET['name'];
        if($this->request->isGet()) {
            unlink("../images/".$image);
            $this->request->redirect('/admin/medias');
        } else {
            $this->request->redirect('/admin/medias');
        }
    }
}