<?php
namespace Core\Migration;
use Core\Database\DB;

class seeder
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "INSERT INTO pages (title, url, content, status)
                VALUE('Sample Page', '/sample-page', '<h1>Page d\'exemple</h1><p>Ceci est une page d\'exemple. C\'est différent d\'un article car elle restera au même endroit et apparaîtra dans la navigation de votre site. La plupart des gens commencent par une page À propos qui les présente aux visiteurs potentiels du site.</p>', 'Publié');
                
                INSERT INTO articles (title, slug, content, status)
                VALUE('Hello World', 'hello-world', '<h1>Hello World !</h1><p>Bienvenue sur GoSchool. Ceci est ton premier article. Edite le ou supprime le, puis commence à créer !</p>','Publié');";

        $conn->exec($sql);
    }
}