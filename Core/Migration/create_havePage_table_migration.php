<?php
namespace Core\Migration;
use Core\Database\DB;

class create_havePage_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS havePage
        (
            `menu_id` BIGINT(20) NULL,
            `page_id` BIGINT(20) NULL,
            `article_id` BIGINT(20) NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP

        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}