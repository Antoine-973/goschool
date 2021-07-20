<?php
namespace Core\Migration;
use Core\Database\DB;

class relation_roles_have_permission_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "ALTER TABLE havePermission
                ADD FOREIGN KEY (`role_id`)
                REFERENCES `roles`(`id`) ON UPDATE CASCADE ON DELETE CASCADE;

                ALTER TABLE havePermission
                ADD FOREIGN KEY (`permission_id`)
                REFERENCES `permissions`(`id`) ON UPDATE CASCADE ON DELETE CASCADE;";

        $conn->exec($sql);
    }
}