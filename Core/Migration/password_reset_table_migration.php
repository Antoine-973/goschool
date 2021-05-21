<?php
namespace Core\Migration;
use Core\Database\DB;

class password_reset_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE password_reset
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `email` VARCHAR(55) NOT NULL,
            `token` VARCHAR(255) NOT NULL,
            `selector` VARCHAR(255) NOT NULL,
            `expires` VARCHAR(100) NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        
        ) ENGINE=INNODB CHARSET=`utf8`;";

        $conn->exec($sql);
    }
}