<?php
namespace Core\Migration;
use Core\Database\DB;

class create_permissions_table_migration{
    
    public function up()
    {
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS permissions
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `authorization` VARCHAR(50) NOT NULL,
            `description` VARCHAR(400) NOT NULL,
            `catégorie` VARCHAR(50) NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP    
    ) ENGINE=INNODB CHARSET=`utf8`;";

        $conn->exec($sql);
    }

    public function down()
    {

    }
}