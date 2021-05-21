<?php
namespace Core\Migration;
use Core\Database\DB;

class articles_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS articles
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(255) NULL,
            `content` TEXT NULL,
            `tags_id` BIGINT(20) NULL,
            `categories_id` BIGINT(20) NULL,
            `image` VARCHAR(255) NULL,
            `status` VARCHAR(55) NOT NULL DEFAULT 'unpublished',
            `active_comment` TINYINT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB CHARSET=`utf8`;";

        $conn->exec($sql);
    }
}