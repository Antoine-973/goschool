<?php
namespace Core\Routing;
use Core\Http\Request;
class Layout {

    public function getMenu()
    {
        $menuFile = $this->getTemplateFolder() . "menu.phtml";

        \ob_start();
        include $this->getTemplateFolder() . "menu.phtml";
        return \ob_get_clean();
    }

    public function getSide()
    {
        $asideFile = $this->getTemplateFolder() . "side.phtml";

        \ob_start();
        include $this->getTemplateFolder() . "side.phtml";
        return \ob_get_clean();
    }

    public function getFooter()
    {
        $footerFile = $this->getTemplateFolder() . "footer.phtml";

        \ob_start();
        include $this->getTemplateFolder() . "footer.phtml";
        return \ob_get_clean();
    }

    public function getContent()
    {

        $request = new Request();

        $arr = explode('/', $request->getPath());

        if (count($arr) == 3){
            if ($arr['1'] == 'article'){
                return$this->getArticleContent();
            }
        }
        elseif(count($arr) == 2 && $arr[1] == 'articles'){

        }
        else{
            return $this->getPageContent();
        }
    }

    public function getPageContent()
    {
        \ob_start();
        include $this->getTemplateFolder() . "contentPage.phtml";
        return \ob_get_clean();
    }

    public function getArticleContent()
    {
        \ob_start();
        include $this->getTemplateFolder() . "contentArticle.phtml";
        return \ob_get_clean();
    }

    public function getArticles()
    {
        \ob_start();
        include $this->getTemplateFolder() . "articles.phtml";
        return \ob_get_clean();
    }

    public function getListArticles()
    {
        \ob_start();
        include $this->getTemplateFolder() . "listArticles.phtml";
        return \ob_get_clean();
    }

    public function getComments()
    {
        \ob_start();
        include $this->getTemplateFolder() . "comments.phtml";
        return \ob_get_clean();
    }

    protected function getTemplateFolder()
    {
        return dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "App" .DIRECTORY_SEPARATOR . "Views" .DIRECTORY_SEPARATOR . "template" .DIRECTORY_SEPARATOR;
    }

    
    protected function getPageFolder()
    {
        return dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "App" .DIRECTORY_SEPARATOR . "Views" .DIRECTORY_SEPARATOR . "site" .DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR;
    }

    protected function getArticleFolder()
    {
        return dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "App" .DIRECTORY_SEPARATOR . "Views" .DIRECTORY_SEPARATOR . "site" .DIRECTORY_SEPARATOR . "articles" . DIRECTORY_SEPARATOR;
    }

}