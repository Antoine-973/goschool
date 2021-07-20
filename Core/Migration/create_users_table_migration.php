<?php
namespace Core\Migration;
use Core\Database\DB;

class create_users_table_migration{
    
    public function up()
    {
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS users
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `firstname` VARCHAR(25) NOT NULL,
            `lastname` VARCHAR(25) NOT NULL,
            `email` VARCHAR(55) NOT NULL UNIQUE,
            `password_hash` VARCHAR(255) NOT NULL,
            `verified` BOOL DEFAULT 0,
            `token_verified` VARCHAR(255),
            `role_id` BIGINT(20) NOT NULL DEFAULT '7',
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP   
    ) ENGINE=INNODB CHARSET=`utf8`;";

        $conn->exec($sql);
    }

    public function down()
    {

    }
}