<?php
namespace Core\Http;

class Session{
    
    private const FLASH_KEY = 'FLASH_KEY';

    public function __construct()
    {
        \session_start();

        $messages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach($messages as $kety => &$message){
            $messages['remove'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $messages;
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

        foreach($messages as $key => &$message){
            if($messages['remove']){
                unset($messages[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] = $messages;
    }
}