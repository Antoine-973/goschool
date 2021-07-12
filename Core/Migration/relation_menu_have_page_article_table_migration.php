<?php
namespace Core\Migration;
use Core\Database\DB;

class relation_menu_have_page_article_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "ALTER TABLE havePage
                ADD FOREIGN KEY (`menu_id`)
                REFERENCES `menus`(`id`) ON UPDATE CASCADE ON DELETE SET NULL;

                ALTER TABLE havePage
                ADD FOREIGN KEY (`page_id`)
                REFERENCES `pages`(`id`) ON UPDATE CASCADE ON DELETE SET NULL;

                ALTER TABLE havePage
                ADD FOREIGN KEY (`article_id`)
                REFERENCES `articles`(`id`) ON UPDATE CASCADE ON DELETE SET NULL;";

        $conn->exec($sql);
    }
}