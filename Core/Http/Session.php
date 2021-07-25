<?php
namespace Core\Http;

class Session{
    
    private const FLASH_KEY = 'FLASH_KEY';
    private const USER_DATA = 'USER_DATA';

    public function __construct()
    {

        if(!isset($_SESSION))
        {
            session_start();
        }

        $messages = $_SESSION[self::FLASH_KEY] ?? [];
        $users = $_SESSION[self::USER_DATA] ?? [];

        foreach($messages as $key => $message){
            $messages['remove'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $messages;
        $_SESSION[self::USER_DATA] = $users;
    }

    public function getSession($key){
        return $_SESSION[self::USER_DATA][$key] ?? [];
    }

    public function setSession($key, $value){
        $_SESSION[self::USER_DATA] = [$key => $value];
    }

    public function setMessage($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getMessage($key)
    {
        $message = $_SESSION[self::FLASH_KEY][$key]['value'] ?? [];
        $this->delete($key);

        if (!is_null($message)){
            return $message;
        }

        return null;
    }

    public function delete(string $key) :void
    {
        unset($_SESSION[self::FLASH_KEY][$key]);
    }
}