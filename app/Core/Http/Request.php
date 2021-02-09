<?php
namespace Core\Http;
class Request
{
    protected $params = [];
    protected $url;

    public function __construct(){

        if(isset($_SERVER['REQUEST_URI'])){

            $uri = trim($_SERVER['REQUEST_URI'], '/');

            if($uri == ""){
                $this->url="/";

                
            }else{
                $uri = explode('/', $uri);
                
                if(count($uri) >= 3){
                    $this->params = array_slice($uri, 2);
                    $this->url = "/" . implode('/', array_slice($uri, 0,2));
                }else{
                    $this->url = "/" . implode('/',$uri);
                }
            }
  
        }
  
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getParams()
    {
        return $this->params;
    }


}