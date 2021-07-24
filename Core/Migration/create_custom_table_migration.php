<?php
namespace Core\Migration;
use Core\Database\DB;

class create_custom_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS customs
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `h1_size` DECIMAL(3,2) NOT NULL DEFAULT '2.5',
            `h2_size` DECIMAL(3,2) NOT NULL DEFAULT '2',
            `h3_size` DECIMAL(3,2) NOT NULL DEFAULT '1.88',
            `h4_size` DECIMAL(3,2) NOT NULL DEFAULT '1.5',
            `p_size` DECIMAL(3,2) NOT NULL DEFAULT '1',
            `h1_color` VARCHAR(25) NOT NULL DEFAULT '363740',
            `h2_color` VARCHAR(25) NOT NULL DEFAULT '363740',
            `h3_color` VARCHAR(25) NOT NULL DEFAULT '363740',
            `h4_color` VARCHAR(25) NOT NULL DEFAULT '363740',
            `p_color` VARCHAR(25) NOT NULL DEFAULT '363740',
            `police` VARCHAR(55) NOT NULL DEFAULT 'Police',
            `nav_bg_color` VARCHAR(25) NOT NULL DEFAULT '363740',
            `menu_color` VARCHAR(25) NOT NULL DEFAULT 'ced4da',
            `foot_bg_color` VARCHAR(25) NOT NULL DEFAULT '363740',
            `foot_color` VARCHAR(25) NOT NULL DEFAULT '6c757d',
            `side_bg_color` VARCHAR(25) NOT NULL DEFAULT '363740',
            `side_color` VARCHAR(25) NOT NULL DEFAULT 'ced4da',
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}