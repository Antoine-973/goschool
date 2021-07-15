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
                VALUE('Hello World', 'hello-world', '<h1>Hello World !</h1><p>Bienvenue sur GoSchool. Ceci est ton premier article. Edite le ou supprime le, puis commence à créer !</p>','Publié');
                
                INSERT INTO categories (name, slug, categorie_parent)
                VALUES('Non-classé', 'non-classé', NULL),
                       ('Esgi','esgi', NULL),
                       ('Évènement','évènement', NULL),
                       ('Web', 'web', NULL),
                       ('Blockchain', 'blockchain', NULL),
                       ('IA', 'ia', NULL),
                       ('Big-data', 'big-data', NULL),
                       ('Jeux-vidéos', 'jeux-vidéos', NULL),
                       ('Réseaux', 'réseaux', NULL),
                       ('Sécurité', 'sécurité', NULL),
                       ('Spécialisation','spécialisation','Esgi'),
                       ('Architecture-Logiciels','architecture-logiciels','Spécialisation'),
                       ('Mobilité-Objet-Connectés','mobilité-objet-connectés','Spécialisation'),
                       ('Ingénierie-Web','ingénierie-web','Spécialisation'),
                       ('Intelligence-Artificielle-Big-Data','intelligence-artificielle-big-data','Spécialisation'),
                       ('Ingénierie-Jeux-Vidéos','ingénierie-jeux-vidéos','Spécialisation'),
                       ('Systèmes-Réseaux','systèmes-réseaux','Spécialisation'),
                       ('Sécurité-Informatique','sécurité-informatique','Spécialisation'),
                       ('Management-Système-Information','management-système-information','Spécialisation');
                
                INSERT INTO users(firstname, lastname, email, password_hash, roles, verified)
                VALUES('Test', 'Test', 'test@goschool.fr', '".password_hash('#Test1234', PASSWORD_BCRYPT)."', 'admin','1'),
                ('Antoine', 'Saunier', 'asaunier@goschool.fr', '".password_hash('#Test1234', PASSWORD_BCRYPT)."', 'admin','1'),
                ('Christian', 'Mohindo', 'cmohindo@goschool.fr', '".password_hash('#Test1234', PASSWORD_BCRYPT)."', 'admin','1'),
                ('Calvin', 'Inthasakubol', 'cInthasakubol@goschool.fr', '".password_hash('#Test1234', PASSWORD_BCRYPT)."', 'admin','1'),
                ('John', 'Doe', 'john.doe@anonymous.ru', '".password_hash('#John1234', PASSWORD_BCRYPT)."', 'editeur','1'),
                ('Jane', 'Doe', 'jane.doe@anonymous.ru', '".password_hash('#Jane1234', PASSWORD_BCRYPT)."', 'contributeur','1'),
                ('Gael', 'Coat', 'gael.coat@cpassorciertechnologierecrute.fr', '".password_hash('#Gael1234', PASSWORD_BCRYPT)."', 'abonné','1'),
                ('Tony', 'Vaucelle', 'tony.vaucelle@referencement.seo', '".password_hash('#Tony1234', PASSWORD_BCRYPT)."', 'auteur','1'),
                ('Yves', 'Skrzypczyk', 'yves.skrzypczyk@yopmail.com', '".password_hash('#MonNomDeFamilleEstUnMotDePasse1234', PASSWORD_BCRYPT)."', 'big-brother','1');

                INSERT INTO comments (message, status, user_id, article_id)
                VALUES('Bonjour ceci est un commentaire de test. Pour commencer à modérer, éditer et supprimer des commentaires, veuillez visiter l\'écran Commentaires dans le tableau de bord. ', 'Approuvé', '1', '1'),
                       ('Bienvenue sur goschool !','Approuvé', '2', '1'),
                       ('C\'est très bien goSchool mais je préfère Drupal !','Approuvé', '3', '1'),
                       ('Trop bien ce site, sinon vous saviez que je suis fan de Berserk ?','Approuvé', '4', '1'),
                       ('Yves Skrzypczyk Approves GoSchool !', 'Approuvé', '9', '1'),
                       ('Bonjour, je suis actuellement à la recherche d\'élèves de l\'ESGI pour les interner, euh non les employés dans mon entreprise : C\'est Pas Sorcier Technologie, contactez moi si vous êtes intéréssé !', 'Approuvé', '7', '1'),
                       ('Sinon vous saviez que j\'adore la méthode agile, Laravel mais aussi et surtout Quentin Tarantino ?', 'Approuvé', '7', '1'),
                       ('Je suis désolé de vous le dire mais le SEO de votre site est à chier, voici le lien de google Ads : https://ads.google.com/intl/fr_fr/home/', 'Approuvé', '8', '1'),
                       ('N\'hésitez pas à cliquer sur ce lien pour optimiser votre SEO gratuitement et automatiquement d\'un simple clic : https://amzn.to/3ivi4lE', 'Approuvé', '8', '1'),
                       ('L\'easter egg de goschool est impossible à trouver sans indice o_o, j\'ai tout essayé !', 'Approuvé', '5', '1');";

        $conn->exec($sql);
    }
}