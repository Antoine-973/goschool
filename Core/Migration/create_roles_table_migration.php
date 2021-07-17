<?php
namespace Core\Migration;
use Core\Database\DB;

class create_roles_table_migration{
    
    public function up()
    {
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS roles
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `role` VARCHAR(50) NOT NULL,
            `level` INT(50) NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP   
    ) ENGINE=INNODB CHARSET=`utf8`;";

        $conn->exec($sql);
    }

    public function down()
    {

    }
}