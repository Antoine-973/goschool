<?php
namespace Core\Migration;
use Core\Database\DB;

class pages_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS pages
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `url` VARCHAR(255) NOT NULL,
            `image` VARCHAR(255) NULL,
            `content` TEXT NULL,
            `articles_id` BIGINT(20) NULL,
            `articles_categories_id` BIGINT(20) NULL,
            `articles_tags_id` BIGINT(20) NULL,
            `categorie_parent` BIGINT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}