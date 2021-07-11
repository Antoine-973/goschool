<?php
namespace Core\Migration;
use Core\Database\DB;

class relation_menu_page_article_categorie_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "ALTER TABLE pages
                ADD FOREIGN KEY (`menu_id`)
                REFERENCES `menus`(`id`) ON UPDATE CASCADE ON DELETE SET NULL;

                ALTER TABLE articles
                ADD FOREIGN KEY (`menu_id`)
                REFERENCES `menus`(`id`) ON UPDATE CASCADE ON DELETE SET NULL;

                ALTER TABLE categories
                ADD FOREIGN KEY (`menu_id`)
                REFERENCES `menus`(`id`) ON UPDATE CASCADE ON DELETE SET NULL;";

        $conn->exec($sql);
    }
}