<?php
namespace Core\Migration;
use Core\Database\DB;

class relation_user_comment_article_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "ALTER TABLE comments
                ADD FOREIGN KEY (`article_id`)
                REFERENCES articles(`id`);
                
                ALTER TABLE comments
                ADD FOREIGN KEY (`user_id`)
                REFERENCES users(`id`);";
        $conn->exec($sql);
    }
}