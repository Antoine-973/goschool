<?php
namespace Core\Util;

class Url{

    public function getHostUrl(){

        $actualUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        return $actualUrl;
    }

    public function getActualUrl(){

        $actualUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return $actualUrl;
    }

    public function generateUrlWithParameters(string $location, array $data) : string
    {
        $generateUrl=$this->getHostUrl().$location.'?';
        $lastKey = array_key_last($data);

        foreach ($data as $key => $value){

            if($key == $lastKey) {
                $generateUrl .= $key . '=' . $value;
            }
            else{
                $generateUrl .= $key . '=' . $value . '&';
            }
        }
        return $generateUrl;
    }
}