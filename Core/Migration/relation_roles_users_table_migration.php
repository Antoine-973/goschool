<?php
namespace Core\Migration;
use Core\Database\DB;

class relation_roles_users_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "ALTER TABLE users
                ADD FOREIGN KEY (`role_id`)
                REFERENCES `roles`(`id`) ON UPDATE CASCADE ON DELETE CASCADE;";

        $conn->exec($sql);
    }
}