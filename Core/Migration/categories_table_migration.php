<?php
namespace Core\Migration;
use Core\Database\DB;

class categories_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS categories
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(55) NOT NULL UNIQUE,
            `slug` VARCHAR(55) NOT NULL UNIQUE,
            `description` TEXT NULL,
            `image` VARCHAR(255) NULL,
            `categorie_parent` VARCHAR(55) NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}