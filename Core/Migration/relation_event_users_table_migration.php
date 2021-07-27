<?php
namespace Core\Migration;
use Core\Database\DB;

class relation_event_users_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "ALTER TABLE events
                ADD FOREIGN KEY (`user_id`)
                REFERENCES `users`(`id`) ON UPDATE CASCADE ON DELETE SET NULL;
                
                ALTER TABLE events
                ADD FOREIGN KEY (`categorie_id`)
                REFERENCES `categories`(`id`) ON UPDATE CASCADE ON DELETE SET NULL;";

        $conn->exec($sql);
    }
}