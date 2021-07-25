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
            `default_role` BIGINT(20) DEFAULT '9',
            `default_article_category` BIGINT(20) DEFAULT '1',
            `mail_host` VARCHAR(30) NULL,
            `mail_port` VARCHAR(30) NULL,
            `mail_login` VARCHAR(30) NULL,
            `mail_password` VARCHAR(30) NULL,
            `twitter` VARCHAR(255) NULL,
            `facebook` VARCHAR(255) NULL,
            `linkedin` VARCHAR(255) NULL,
            `instagram` VARCHAR(255) NULL,
            `default_home_page` BIGINT(20) NULL,
            `post_show_count` INT DEFAULT '4',
            `description` TEXT NULL,
            `lang` VARCHAR(25) NOT NULL DEFAULT 'fr',
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}