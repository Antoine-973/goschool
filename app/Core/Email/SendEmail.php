<?php
namespace Core\Email;
class SendEmail{
    private $from;
    private $to;
    private $message;

    public function __construct($from, $to, $message){
        $this->from = $from;
        $this->to = $to;
        $this->message = $message;
    }

    public function send(){
        return $this->message;
    }

    protected function isValidEmail($email){

    }
}