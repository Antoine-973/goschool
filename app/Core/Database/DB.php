<?php
namespace Core\Database;
use Core\Exception\Exception;

class DB extends \PDO
{

  private static $instance = null;

  public function __construct()
  {
        if(!\file_exists(dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR ."config" .DIRECTORY_SEPARATOR."database.yml")){

            throw new Exception("database.yml config file does'nt exists");
        }else{

            $db_config_file = dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR ."config" .DIRECTORY_SEPARATOR."database.yml";
           
            ($config = yaml_parse_file($db_config_file)) || die("YAML file not found");

            $conn = $config['driver'].":host=".$config['host'].";dbname=".$config['dbname'];

            $options = array(
                \PDO::ATTR_PERSISTENT => true,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            );

            try{

                self::$instance = new \PDO($conn, $config['username'], $config['password'], $options);

            }catch(\PDOException $e){
                echo $e->getMessage();
            }
        }


  }

  public static function getConnection()
  {  
    if(is_null(self::$instance))
    {
      self::$instance = new DB();
    }
    return self::$instance;
  }

}
