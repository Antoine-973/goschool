<?php
namespace Core\Routing;
use Core\Util\Helper;
class Template
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Helper();
    }

    public function getSiteLayout()
    {
        $data['helper'] = $this->helper;
        \ob_start();
        extract($data, EXTR_SKIP);
        include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR. "App" . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . "layouts" .  DIRECTORY_SEPARATOR . "siteLayout.phtml";
        return \ob_get_clean();
    }
    
    public function getAdminLayout()
    {
        $data['helper'] = $this->helper;
        \ob_start();
        extract($data, EXTR_SKIP);
        include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR. "App" . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . "layouts" .  DIRECTORY_SEPARATOR . "adminLayout.phtml";
        return \ob_get_clean();
    }


    public function getView($view, $data = [])
    {
        $data['helper'] = $this->helper;
        $viewFile =  dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR. "App" . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view);
        if(\file_exists($viewFile)){
            \ob_start();
            extract($data, EXTR_SKIP);
            include $viewFile;
            return \ob_get_clean();
        }

    }
}