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
        $arr = explode('/', $request->getPath());

        if($request->getPath() == "/"){
            $pageFile = $this->getPageFolder() . "home_page.phtml";
        }
        elseif (count($arr) == 3){
            if ($arr['1'] == 'article'){
                $pageFile = $this->getArticleFolder() . $arr[2] . "_article.phtml";
            }
        }
        else{
            $pageFile = $this->getPageFolder() . strtolower(trim($request->getPath(), "/")) . "_page.phtml";
        }

        if(\file_exists($pageFile)){
        \ob_start();
        include $pageFile;
        return \ob_get_clean();

        }

        
        return "<div class='container'><h1>Bienvenue à l'école de la reussite !</h1>
        Pour commencer <a href='/admin/page/add'>créer une page !</a> Une page Accueil par exemple avec l'url /accueil !<br><br>
        Puis <a href='/admin/menu/add'>créer un menu</a> par exemple Navbar, et ajouter-y votre page Accueil !<br><br>
        Le thème de base de goSchool a un emplacement de menu en haut (navbar) et en bas (footer).<br><br>
        Pour afficher notre menu Navbar sur le site vous devez justement <a href='/admin/menu/position'> modifier l'emplacement de menu Navbar !</a><br><br>
        Maintenant cliquer sur le lien Accueil dans le menu, le lien devrait être le suivant : <a href='/accueil'>Accueil</a>
        <h6>Et voilà votre première page ! À vous la gloire !</h6>
        Vous pouvez maintenant changer les paramètres de GoSchool pour changer notre page d'accueil par défaut par votre magnifique nouvelle page d'accueil !<br>
        <ul>Bonne découverte de GoSchool vous pouvez essayez :
            <li>De créer un article qui va s'afficher dans vos derniers articles !</li>
            <li>De créer des utilisateurs pour votre équipe !</li>
            <li>De créer des catégories pour vos prochains articles !</li>
        </ul>
        Et surtout faites nous part de votre expérience à cette adresse email <a href='mailto:'>contact.goschool@gmail.com</a>
        <h4>Amusez vous bien !</h4></div>
        ";
    }

    public function getArticles()
    {
        $footerFile = $this->getTemplateFolder() . "articles.phtml";

        \ob_start();
        include $this->getTemplateFolder() . "articles.phtml";
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