<?php
namespace Core\Migration;
use Core\Database\DB;

class parameters_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS parameters
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `site_name` VARCHAR(55) NOT NULL DEFAULT 'Mon site',
            `url` VARCHAR(255) NULL,
            `visible` VARCHAR(25) DEFAULT 'Publique',
            `default_role` TINYINT DEFAULT '1',
            `name_role` VARCHAR(16) DEFAULT 'admin',
            `description` TEXT NULL,
            `lang` VARCHAR(25) NOT NULL DEFAULT 'fr',
            `save` TINYINT DEFAULT '0',
            `update` TINYINT DEFAULT '0'
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}