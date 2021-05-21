<?php
namespace Core\Util;

class Slug{

    /**
     * @return string $slug
     */
    public function autoLinks(string $str): string
    {
        $str = preg_replace('~[^\pL\d]+~u', '-', $str);
        $str = iconv('utf-8', 'us-ascii//TRANSLIT', $str);
        $str = preg_replace('~[^-\w]+~', '', $str);
        $str = trim($str, '-');
        $str = preg_replace('~-+~', '-', $str);
        $str = strtolower($str);

        if(empty($str)) {
            return 'n-a';
        }else{
            return $str;
        }
    }
}