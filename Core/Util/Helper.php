<?php
namespace Core\Util;
use Core\Http\Session;
class Helper
{
    public function __construct()
    {

    }

    
    /**
     * @param string $path
     * @return string public folder path
     */
    
    public function public(string $path = ""): string
    {
        if(!empty($path)){
            return "/public/" . $path;
        }

        return dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR;
    }

    public function getFormatedDate()
    {
        
    }

    public function getFlashMessage($key)
    {
        $session = Session::getSession();
        return $session->getMessage($key);
    }

}