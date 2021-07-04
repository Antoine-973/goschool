<?php
namespace Core\Migration;
use Core\Database\DB;

class comments_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS comments
        (
            `id`  BIGINT(20) NOT NULL AUTO_INCREMENT,
            `title`  varchar(100) NOT NULL,
            `message` TEXT NULL,
            `status` varchar(20) DEFAULT 'En-attente' NOT NULL,
            `users_id` BIGINT(20),
            `articles_id` BIGINT(20),
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            FOREIGN KEY (articles_id) REFERENCES articles(id),
            FOREIGN KEY (users_id) REFERENCES users(id)

        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}