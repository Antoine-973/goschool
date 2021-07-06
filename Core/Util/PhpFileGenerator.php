<?php
namespace Core\Util;

class PhpFileGenerator{

    public function clearUrl($url){
        $explodeUrl=explode('/', strtolower($url));
        $clearUrl='';
        foreach ($explodeUrl as $key => $value){
            if (!empty($explodeUrl[$key])){
                if ($clearUrl == ''){
                    $clearUrl .= $explodeUrl[$key];
                }
                else{
                    $clearUrl .= "-". $explodeUrl[$key];
                }

            }
        }
        return $clearUrl;
    }

    public function generateViewFile($viewName, $viewContent, $postType){

        if ($postType == 'pages'){

            $urlToName = $this->clearUrl($viewName);
            $cleanName = $urlToName . '_page.phtml';

            return file_put_contents("../App/Views/site/".$postType."/".$cleanName, str_replace( '&', '&amp;', html_entity_decode($viewContent)));
        }
        elseif($postType == 'articles'){
            $titleToName = str_replace(" ", "-", $viewName);
            $cleanName = strtolower($titleToName) . '_article.phtml';

            return file_put_contents("../App/Views/site/".$postType."/".$cleanName, str_replace( '&', '&amp;', html_entity_decode($viewContent)));
        }
        else{
            throw new Exception('generateViewFile need a valid postType (articles or pages)');
        }
    }

    public function deleteViewFile($viewName, $postType){
        if ($postType == 'pages'){

            $urlToName = $this->clearUrl($viewName);
            $cleanName = $urlToName . '_page.phtml';

            return unlink("../App/Views/site/".$postType."/".$cleanName);
        }
        elseif($postType == 'articles'){
            $titleToName = str_replace(" ", "-", $viewName);
            $cleanName = strtolower($titleToName) . '_article.phtml';

            return unlink("../App/Views/site/".$postType."/".$cleanName);
        }
        else{
            throw new Exception('generateViewFile need a valid postType (articles or pages)');
        }
    }

}


