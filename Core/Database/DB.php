<?php
namespace Core\Database;
use Core\Util\DotEnv;

class DB extends \PDO
{

  private static $instance = null;

  public function __construct()
  {
        (new DotEnv(dirname(dirname(__DIR__)) . '/.env'))->load();

        $conn =  getenv('DB_DRIVER').":host=".getenv('DB_HOST').";dbname=".getenv('DB_NAME');

        $options = array(
          \PDO::ATTR_PERSISTENT => true,
          \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        );

        try{
          self::$instance = new \PDO($conn, getenv('DB_USER'), getenv('DB_PASSWORD'), $options);

        }catch(\PDOException $e){
          echo $e->getMessage();
        }

  }

  public static function getConnection()
  {  
    if(is_null(self::$instance)){
      self::$instance = new DB();
    }
    return self::$instance;
  }

  public function createMigrationsTable()
  {
    $conn = $this->getConnection();

      $conn->exec("CREATE TABLE IF NOT EXISTS migrations (
          id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
          migration VARCHAR(255),
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB CHARSET=utf8");
  }

  public function applyMigrations()
  {

    $this->createMigrationsTable();
    $appliedMigrations = $this->getAppliedMigrations();

    $newMigrations = [];

    $migrations_dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "Migration";
    $files = scandir($migrations_dir);
    $toApply = array_diff($files, $appliedMigrations);


    foreach($toApply as $migration){
      if($migration == "." || $migration == ".."){
        continue;
      }

      require_once $migrations_dir . DIRECTORY_SEPARATOR . $migration;
      $class = \pathinfo($migration, PATHINFO_FILENAME);
      $className = "Core\\Migration\\" .$class;
     

      if(\class_exists($className)){
        echo "here";
        $instance = new  $className();
        $instance->up();
        $newMigrations[] = $migration;
        
      }

    }

    if(!empty($newMigrations)){
      $this->saveMigrations($newMigrations);

    }

  }

  public function getAppliedMigrations()
  {
    $conn = $this->getConnection();

    $stm = $conn->prepare("SELECT migration FROM migrations");
    $stm->execute();

    return $stm->fetchAll(\PDO::FETCH_COLUMN);
  }

  public function saveMigrations($migrations)
  {
    $tables = array_map(fn($m) => trim("$m", ".php"), $migrations);

    $conn = $this->getConnection();
    foreach($tables as $table){
      $newTable = "'" . $table . "'";
      $stm = $conn->prepare("INSERT INTO migrations (migration) VALUES ($newTable)");
      $stm->execute();
    }

  }

}
