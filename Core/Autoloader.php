<?php
namespace Core;
class Autoloader{

    public static function autoload(){

        spl_autoload_register(function ($className) {
            $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
            $file = dirname(__DIR__ ) . DIRECTORY_SEPARATOR . $className . ".php";
    
            try{
                if (file_exists($file)) {
                    include_once $file;
                }else{
                    throw new \Exception("File doesn't exists: $file");
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        });
    }

}