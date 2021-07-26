<?php
namespace Core;
use Core\Routing\Template;
use Core\Http\Session;
use Core\Util\Helper;
use Core\Middleware\InstallMiddleware;

class Controller{


    public function render($view, $data = [])
    {
        if (strpos($namespace[count($namespace)-1], 'Article') !== false && stripos(debug_backtrace()[1]['function'], 'Add' ) !== false || strpos($namespace[count($namespace)-1], 'Article') !== false && (stripos(debug_backtrace()[1]['function'], 'Edit' ) ) !== false || strpos($namespace[count($namespace)-1], 'Article') !== false && stripos(debug_backtrace()[1]['function'], 'Store' ) !== false || strpos($namespace[count($namespace)-1], 'Article') !== false && stripos(debug_backtrace()[1]['function'], 'Update' ) !== false){
        if(InstallMiddleware::check()){
            $this->view('install.phtml');
        }
        else{
            $template = new Template();
            $viewContent = $template->getView($view, $data);
            $namespace = explode('\\', get_called_class());

            if (strpos($namespace[count($namespace)-1], 'Article') !== false && stripos(debug_backtrace()[1]['function'], 'Add' ) !== false || strpos($namespace[count($namespace)-1], 'Article') !== false && (stripos(debug_backtrace()[1]['function'], 'Edit' ) ) !== false || strpos($namespace[count($namespace)-1], 'Article') !== false && stripos(debug_backtrace()[1]['function'], 'Store' ) !== false || strpos($namespace[count($namespace)-1], 'Article') !== false && stripos(debug_backtrace()[1]['function'], 'Update' ) !== false){
                $contentEditorLayout = $template->getContentEditorLayout();
                echo \str_replace('{{content}}', $viewContent, $contentEditorLayout);
            }
            elseif(strpos($namespace[count($namespace)-1], 'Page') !== false && stripos(debug_backtrace()[1]['function'], 'Add' ) !== false || strpos($namespace[count($namespace)-1], 'Page') !== false && stripos(debug_backtrace()[1]['function'], 'Store' ) !== false || strpos($namespace[count($namespace)-1], 'Page') !== false && stripos(debug_backtrace()[1]['function'], 'Update' ) !== false || strpos($namespace[count($namespace)-1], 'Page') !== false && stripos(debug_backtrace()[1]['function'], 'Edit' ) !== false){
                $contentEditorLayout = $template->getContentEditorLayout();
                echo \str_replace('{{content}}', $viewContent, $contentEditorLayout);
            }
            elseif (strpos($namespace[count($namespace)-1], 'AdminAuthController') !== false){
                $registrationLayout = $template->getRegistrationLayout();
                echo \str_replace('{{content}}', $viewContent, $registrationLayout);
            }
            elseif(strpos($namespace[count($namespace)-1], 'Admin') !== false){
                $adminLayout = $template->getAdminLayout();
                echo \str_replace('{{content}}', $viewContent, $adminLayout);
            }
            elseif(strpos($namespace[count($namespace)-1], 'Error') !== false){
                $adminLayout = $template->getErrorLayout();
                echo \str_replace('{{content}}', $viewContent, $adminLayout);
            }
            else{
                $siteLayout = $template->getSiteLayout();
                echo \str_replace('{{content}}', $viewContent, $siteLayout);
            }
        }
    }

    public function model($model)
    {

        $modelFile =  dirname(__DIR__) . DIRECTORY_SEPARATOR. "App" . DIRECTORY_SEPARATOR . "Model" . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $model . "Model.php");

        if(!file_exists($modelFile)){
           echo "model class doesn't exit: $modelFile";
           exit;
        }

        require $modelFile;
        $modelClass = 'App\\Model\\'.$model;
        return new $modelClass();
    }

    public function view($view)
    {
        $helper = new Helper();

        ob_start();
        extract([ 'helper' => $helper]);
        require dirname(__DIR__) . DIRECTORY_SEPARATOR. "App" . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view);
        echo ob_get_clean();
    }

    public function registerMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }


}