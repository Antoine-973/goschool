<?php
namespace Core\Migration;
use Core\Database\DB;

class create_events_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS events
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(150) NOT NULL UNIQUE,
            `slug` VARCHAR(170) NOT NULL UNIQUE,
            `description` VARCHAR(200) NULL,
            `status` VARCHAR(30) NOT NULL DEFAULT 'À-Valider',
            `start_date` DATE NOT NULL,
            `end_date` DATE NOT NULL,    
            `categorie_id` BIGINT(20) DEFAULT '1',
            `user_id` BIGINT(20),
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP    
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}