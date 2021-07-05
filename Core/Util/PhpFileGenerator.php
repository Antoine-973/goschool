<?php
namespace Core\Util;

use PHPMailer\PHPMailer\Exception;

class PhpFileGenerator{

    public function generateViewFile($viewName, $viewContent, $postType){

        if ($postType == 'pages' || $postType == 'articles'){

            $titleToName = explode(" ", $viewName);
            $cleanName = strtolower($titleToName[0]);

            return file_put_contents("../App/Views/site/".$postType."/".$cleanName.".phtml", str_replace( '&', '&amp;', html_entity_decode($viewContent)));
        }
        else{
            throw new Exception('generateViewFile need a valid postType (articles or pages)');
        }
    }

}


