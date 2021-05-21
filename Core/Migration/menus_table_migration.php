<?php
namespace Core\Migration;
use Core\Database\DB;

class tags_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS menus
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(55) NOT NULL,
            `description` TEXT NULL,
            `link` VARCHAR(255) NOT NULL,
            `pages_id` BIGINT(20) NULL,
            `pages_articles_id` BIGINT(20) NULL,
            `pages_articles_categories_id` BIGINT(20) NULL,
            `pages_articles_tags_id` BIGINT(20) NULL
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}