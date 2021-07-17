<?php
namespace Core\Migration;
use Core\Database\DB;

class create_havePermission_table_migration{

    public function up(){

        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS havePermission
        (
            `role_id` BIGINT(20) NOT NULL,
            `permission_id` BIGINT(20) NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP

        ) ENGINE=INNODB CHARSET=`utf8`;";

        $conn->exec($sql);

    }

    public function down()
    {

    }
}