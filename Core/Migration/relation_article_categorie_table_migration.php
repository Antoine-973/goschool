<?php
namespace Core\Migration;
use Core\Database\DB;

class relation_article_categorie_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "ALTER TABLE articles
                ADD FOREIGN KEY (`categorie_id`)
                REFERENCES categories(`id`);";

        $conn->exec($sql);
    }
}