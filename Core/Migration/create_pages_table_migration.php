<?php
namespace Core\Migration;
use Core\Database\DB;

class create_pages_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS pages
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL UNIQUE,
            `url` VARCHAR(255) NULL UNIQUE,
            `image` VARCHAR(255) NULL,
            `content` TEXT NULL,
            `status` VARCHAR(55) NOT NULL DEFAULT 'unpublished',
            `menu_id` BIGINT(20) NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}