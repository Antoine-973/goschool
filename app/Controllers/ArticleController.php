<?php

namespace Controller;
use Core\Controller;

class ArticleController extends Controller
{
    public function index(){
        echo "index";die;
        $this->render('home.php');
    }

    public function show($method = null){

        $eleve = [
            'Antoine',
            'Calvine',
            'Christian',
            'Kelig',
            'Antoine'
        ];
        $this->render('list.php', ['eleves' => $eleve]);
    }
}