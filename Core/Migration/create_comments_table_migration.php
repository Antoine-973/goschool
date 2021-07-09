<?php
namespace Core\Migration;
use Core\Database\DB;

class create_comments_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS comments
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `title`  varchar(100) NOT NULL,
            `message` TEXT NULL,
            `status` varchar(20) DEFAULT 'En-attente' NOT NULL,
            `user_id` BIGINT(20) NOT NULL,
            `article_id` BIGINT(20) NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
            
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}