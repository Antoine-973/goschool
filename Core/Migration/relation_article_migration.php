<?php
namespace Core\Migration;
use Core\Database\DB;

class relation_article_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "ALTER TABLE articles
                ADD FOREIGN KEY (`categorie_id`)
                REFERENCES categories(`id`);

                ALTER TABLE articles
                ADD FOREIGN KEY (`user_id`)
                REFERENCES users(`id`);

                ALTER TABLE pages
                ADD FOREIGN KEY (`user_id`)
                REFERENCES users(`id`);
                
                
                ";

        $conn->exec($sql);
    }
}