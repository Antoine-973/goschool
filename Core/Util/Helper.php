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
        $session = new Session();
        return $session->getMessage($key);
    }

    public  function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
        return 'n-a';
    }

    return $text;
    }

}