<?php
namespace Core\Migration;
use Core\Database\DB;

class relation_menu_page_article_categorie_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "ALTER TABLE menus
                ADD FOREIGN KEY (`page_id`)
                REFERENCES `pages`(`id`);

                ALTER TABLE menus
                ADD FOREIGN KEY (`article_id`)
                REFERENCES `articles`(`id`);

                ALTER TABLE menus
                ADD FOREIGN KEY (`categorie_id`)
                REFERENCES `categories`(`id`);";

        $conn->exec($sql);
    }
}