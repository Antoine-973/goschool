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
            `name` VARCHAR(55) UNIQUE NOT NULL,
            `description` TEXT NULL,
            `position` VARCHAR(20) UNIQUE NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}