<?php
namespace Core\Migration;
use Core\Database\DB;

class create_articles_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS articles
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(50) NOT NULL UNIQUE,
            `slug` VARCHAR(50) NOT NULL UNIQUE,
            `description` VARCHAR(400) NULL,
            `content` TEXT NULL,
            `image` VARCHAR(255) NULL,
            `status` VARCHAR(30) NOT NULL DEFAULT 'Brouillon',
            `active_comment` TINYINT NULL DEFAULT 0,
            `user_id` BIGINT(20) NOT NULL,
            `categorie_id` BIGINT(20) DEFAULT '1',
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP

        ) ENGINE=INNODB CHARSET=`utf8`;";

        $conn->exec($sql);
    }
}