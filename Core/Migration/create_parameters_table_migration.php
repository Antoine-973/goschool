<?php
namespace Core\Migration;
use Core\Database\DB;

class create_parameters_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS parameters
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `site_name` VARCHAR(55) NOT NULL DEFAULT 'Mon site',
            `url` VARCHAR(255) NULL,
            `visible` VARCHAR(25) DEFAULT 'Publique',
            `default_role` TINYINT DEFAULT '7',
            `name_role` VARCHAR(16) DEFAULT 'Abonné',
            `default_article_category` TINYINT DEFAULT '1',
            `mail_host` VARCHAR(30) NULL,
            `mail_port` VARCHAR(30) NULL,
            `mail_login` VARCHAR(30) NULL,
            `mail_password` VARCHAR(30) NULL,
            `default_home_page` VARCHAR(30) NULL,
            `post_show_count` INT DEFAULT '4',
            `tag_line` VARCHAR(50) NULL,
            `description` TEXT NULL,
            `lang` VARCHAR(25) NOT NULL DEFAULT 'fr',
            `save` TINYINT DEFAULT '0',
            `update` TINYINT DEFAULT '0',
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}