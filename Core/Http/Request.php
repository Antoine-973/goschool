<?php
namespace Core\Http;
/**
 * @class Core\Request
 * @author Christian Mohindo
 */
use Core\Http\Session;

class Request{

    /**
     * @return string $httpPath
     */
    public function getPath(): string
    {
        $httpPath = $_SERVER['REQUEST_URI'] ?? "/";

        $position = \strpos($httpPath, '?');

        if($position === false){
            return  $httpPath;
        }

        return substr($httpPath, 0, $position);
    }

    /**
     * @return string $httpMethod
     */
    public function getMethod(): string
    {
        return \strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return array $httpParams
     */
    public function getParams(): array
    {

    }

    /**
     * @return $httpBody
     */
    public function getBody(): array 
    {
        $httpBody = [];

        if($this->isGet()){
            foreach($_GET as $key => $value){
               $httpBody[$key] = \filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if($this->isPost()){
            foreach($_POST as $key => $value){
                $httpBody[$key] = \filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $httpBody;
    }

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    public function redirect($route, $statusCode = 303)
    {
       
        header('Location: ' . $route, true, $statusCode);
        return $this;
    }

    public function with($key, $message)
    {
        $session = new Session();
        $session->setMessage($key, $message);
    }

}