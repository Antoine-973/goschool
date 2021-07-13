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
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? [];
    }

    public function __destruct()
    {
        
        $messages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach($messages as $key => $message){
            if(array_key_exists('remove', $messages)){
                unset($messages[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] = $messages;
    }
}