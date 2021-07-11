<?php
namespace Core\Migration;
use Core\Database\DB;

class create_menus_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS menus
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(55) NOT NULL,
            `description` TEXT NULL,
            `position` VARCHAR(20) NULL
            
            
    
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}