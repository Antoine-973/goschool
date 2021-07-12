<?php
namespace Core\Util;

include('../Core/Vendor/htmLawed/htmLawed.php');

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
                    $clearUrl .= "_". $explodeUrl[$key];
                }

            }
        }
        return $clearUrl;
    }

    public function generateViewFile($viewName, $viewContent, $postType){

        if ($postType == 'pages'){

            $urlToName = $this->clearUrl($viewName);
            $cleanName = $urlToName . '.html';

            $cleanContent = str_replace( '&nbsp', '', html_entity_decode($viewContent));
            $indentContent = htmLawed($cleanContent, array('tidy'=>4));

            return file_put_contents("../App/Views/site/".$postType."/".$cleanName, str_replace( '&', '&amp;', html_entity_decode($indentContent)));
        }
        elseif($postType == 'articles'){
            $titleToName = str_replace(" ", "-", $viewName);
            $cleanName = strtolower($titleToName) . '_article.html';

            $cleanContent = str_replace( '&nbsp', '', html_entity_decode($viewContent));
            $indentContent = htmLawed($cleanContent, array('tidy'=>4));

            return file_put_contents("../App/Views/site/".$postType."/".$cleanName, $indentContent);
        }
    }

    public function deleteViewFile($viewName, $postType){
        if ($postType == 'pages'){

            $urlToName = $this->clearUrl($viewName);
            $cleanName = $urlToName . '_page.html';

            return unlink("../App/Views/site/".$postType."/".$cleanName);
        }
        elseif($postType == 'articles'){

            $titleToName = str_replace(" ", "-", $viewName);
            $cleanName = strtolower($titleToName) . '_article.html';

            return unlink("../App/Views/site/".$postType."/".$cleanName);
        }
    }

}


