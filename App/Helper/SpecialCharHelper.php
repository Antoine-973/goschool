<?php
namespace Helper;

class SpecialCharHelper{
    /**
     * @param $string
     * @return string
     * Return le string parser avec htmlspecialchar
     */
    public static function getSpecialChars($string)
    {
        return htmlspecialchars(htmlspecialchars($string, ENT_QUOTES));

    }
}