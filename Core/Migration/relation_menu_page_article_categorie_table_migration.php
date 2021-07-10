<?php
namespace Core\Migration;
use Core\Database\DB;

class relation_menu_page_article_categorie_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "ALTER TABLE menus
                ADD FOREIGN KEY (`page_id`)
                REFERENCES `pages`(`id`) ON UPDATE CASCADE ON DELETE SET NULL;

                ALTER TABLE menus
                ADD FOREIGN KEY (`article_id`)
                REFERENCES `articles`(`id`) ON UPDATE CASCADE ON DELETE SET NULL;

                ALTER TABLE menus
                ADD FOREIGN KEY (`categorie_id`)
                REFERENCES `categories`(`id`) ON UPDATE CASCADE ON DELETE SET NULL;";

        $conn->exec($sql);
    }
}