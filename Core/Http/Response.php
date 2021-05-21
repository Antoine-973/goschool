<?php
namespace Core\Http;

class Response {

    private $code;

    public function setStatusCode(int $code){
        \http_response_code($code);
        $this->code = $code;
    }

    public function getStatusCode(){
        return $this->code;
    }
}