<?php
namespace Core;
use Core\Routing\Template;
use Core\Http\Session;
class Controller{

    public function render($view, $data = [])
    {

        $template = new Template();
        $viewContent = $template->getView($view, $data);

        if(strpos(get_called_class(), 'Admin') !== false){
            $adminLayout = $template->getAdminLayout();
            echo \str_replace('{{content}}', $viewContent, $adminLayout);
        }else{
            
            $siteLayout = $template->getSiteLayout();
            echo \str_replace('{{content}}', $viewContent, $siteLayout);
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


}