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

    public function getAside()
    {
        $asideFile = $this->getTemplateFolder() . "aside.phtml";

        \ob_start();
        include $this->getTemplateFolder() . "aside.phtml";
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

        $pageFile = "";

        if($request->getPath() == "/"){
            $pageFile = $this->getPageFolder() . "home_page.phtml";
        }else{
            $pageFile = $this->getPageFolder() . strtolower(trim($request->getPath(), "/")) . "_page.phtml";

        }


        if(\file_exists($pageFile)){
        \ob_start();
        include $pageFile;
        return \ob_get_clean();

        }

        
        return "<h1>Hello World !</h1><br><br><br><br>
        <h1>Hello World !</h1><br><br><br><br>
        <h1>Hello World !</h1><br><br><br><br>
        <h1>Hello World !</h1><br><br><br><br>
        <h1>Hello World !</h1><br><br><br><br>
        <h1>Hello World !</h1><br><br><br><br>
        <h1>Hello World !</h1><br><br><br><br>
        <h1>Hello World !</h1><br><br><br><br>
        ";
    }

    public function getArticles()
    {
        $footerFile = $this->getTemplateFolder() . "articles.phtml";

        \ob_start();
        include $this->getTemplateFolder() . "articles.phtml";
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



}