<?php
namespace Core\Migration;
use Core\Database\DB;

class seeder
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "               
                INSERT INTO parameters (site_name)
                VALUE('Esgi');
                
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

                INSERT INTO roles(role, level)
                VALUES('Big-Brother', '1'),
                ('Administrateur', '2'),
                ('Éditeur', '3'),
                ('Auteur', '4'),
                ('Vie-Scolaire', '5'),
                ('Professeur', '6'),
                ('Abonné', '7');

                INSERT INTO permissions(authorization,description, catégorie)
                VALUES('access_back_office','Acceder au back office', 'Générales'), 
                ('crud_user', 'Create/Update/Delete des utilisateurs', 'Utilisateurs'),
                ('crud_page', 'Create/Update/Delete des pages', 'Pages'),
                ('approve_page', 'Approuvé des pages', 'Pages'),
                ('crud_self_page', 'Create/Update/Delete de ses propres pages', 'Pages'),       
                ('crud_article', 'Create/Update/Delete des articles', 'Articles'),
                ('approve_article','Approuvé des articles', 'Articles'),
                ('crud_self_article','Create/Update/Delete de ses propres articles', 'Articles'),                       
                ('crud_comment', 'Create/Update/Delete des commentaires', 'Commentaires'),                
                ('approve_comment', 'Approuvé des commentaires', 'Commentaires'),
                ('crud_self_comment', 'Create/Update/Delete ses propres commentaires', 'Commentaires'),
                ('change_roles_permission', 'Create/Update/Delete des permissions', 'Roles'),
                ('crud_menu', 'Create/Update/Delete des menus', 'Menus'),
                ('change_menu_position', 'Changer les positions des menus', 'Menus'),
                ('crud_categorie', 'Create/Update/Delete des catégories', 'Catégories'),
                ('crud_event', 'Create/Update/Delete des évènements', 'Évènemenents'),
                ('approve_event', 'Approuvé des évènements', 'Évènemenents'),
                ('crud_self_event', 'Create/Update/Delete ses propres évènements', 'Évènemenents'),       
                ('change_theme', 'Changer le theme du site', 'Themes'),
                ('customize_site', 'Personnaliser le site', 'Personnalisation'),
                ('change_parameters', 'Changer les paramètres du site', 'Paramètres'),
                ('crud_media', 'Ajouter des médias dans le back office', 'Medias'),  
                ('crud_self_media', 'Supprimer des médias dans le back office', 'Medias'),      
                ('crud_newsletter', 'Create/Update/Delete les newsletters', 'Newsletter'),
                ('crud_self_newsletter', 'Create/Update/Delete ses propres newsletter', 'Newsletter'); 

                INSERT INTO havePermission(role_id, permission_id)
                VALUES('1', '1'),
                ('1', '2'),
                ('1', '3'),
                ('1', '4'),
                ('1', '6'),
                ('1', '7'),
                ('1', '9'),
                ('1', '10'),
                ('1', '12'),
                ('1', '13'),
                ('1', '14'),
                ('1', '15'),
                ('1', '16'),
                ('1', '17'),
                ('1', '19'),
                ('1', '20'),
                ('1', '21'),
                ('1', '22'),
                ('1', '24'),
                ('2', '1'),
                ('2', '2'),
                ('2', '3'),
                ('2', '4'),
                ('2', '6'),
                ('2', '7'),
                ('2', '9'),
                ('2', '10'),
                ('2', '12'),
                ('2', '13'),
                ('2', '14'),
                ('2', '15'),
                ('2', '16'),
                ('2', '17'),
                ('2', '19'),
                ('2', '20'),
                ('2', '21'),
                ('2', '22'),  
                ('2', '24'),  
                ('3', '1'),
                ('3', '5'),
                ('3', '6'),
                ('3', '7'),
                ('3', '8'),
                ('3', '9'),
                ('3', '10'),
                ('3', '13'),
                ('3', '15'),
                ('3', '16'),
                ('3', '17'),
                ('3', '22'),
                ('3', '23'),
                ('3', '24'),
                ('4', '1'),
                ('4', '6'),
                ('4', '7'),
                ('4', '11'),
                ('4', '16'),
                ('4', '17'),
                ('4', '22'),    
                ('5', '1'),
                ('5', '8'),
                ('5', '9'),
                ('5', '10'),
                ('5', '16'),
                ('5', '17'),    
                ('5', '23'),       
                ('5', '25'),    
                ('6', '1'),
                ('6', '8'),
                ('6', '11'),
                ('6', '18'),
                ('6', '23'),    
                ('7', '11');       
                       
                INSERT INTO users(firstname, lastname, fullname, email, password_hash, role_id, verified)
                VALUES('Test', 'Test', 'Test Test', 'test@goschool.fr', '".password_hash('#Test1234', PASSWORD_BCRYPT)."', '2','1'),
                ('Antoine', 'Saunier', 'Antoine Saunier', 'asaunier@goschool.fr', '".password_hash('#Test1234', PASSWORD_BCRYPT)."', '2','1'),
                ('Christian', 'Mohindo', 'Christian Mohindo', 'cmohindo@goschool.fr', '".password_hash('#Test1234', PASSWORD_BCRYPT)."', '2','1'),
                ('Calvin', 'Inthasakubol', 'Calvin Inthasakubol', 'cinthasakubol@goschool.fr', '".password_hash('#Test1234', PASSWORD_BCRYPT)."', '2','1'),
                ('John', 'Doe', 'John Doe', 'john.doe@anonymous.ru', '".password_hash('#John1234', PASSWORD_BCRYPT)."', '3','1'),
                ('Jane', 'Doe', 'Jane Doe', 'jane.doe@anonymous.ru', '".password_hash('#Jane1234', PASSWORD_BCRYPT)."', '5','1'),
                ('Gael', 'Coat', 'Gael Coat', 'gael.coat@cpassorciertechnologierecrute.fr', '".password_hash('#Gael1234', PASSWORD_BCRYPT)."', '6','1'),
                ('Tony', 'Vaucelle', 'Tony Vaucelle', 'tony.vaucelle@referencement.seo', '".password_hash('#Tony1234', PASSWORD_BCRYPT)."', '4','1'),
                ('Yves', 'Skrzypczyk', 'Yves Skrzypczyk', 'yves.skrzypczyk@yopmail.com', '".password_hash('#MonNomDeFamilleEstUnMotDePasse1', PASSWORD_BCRYPT)."', '1','1'),
                ('Alois', 'Marcellin', 'Alois Marcellin', 'alois.marcellin@myges.fr', '".password_hash('#ViveSorcierTechnologie1234', PASSWORD_BCRYPT)."', '7','1');

                INSERT INTO pages (title, url, content, status, user_id)
                VALUE('Sample Page', '/sample-page', '<h1>Page d\'exemple</h1><p>Ceci est une page d\'exemple. C\'est différent d\'un article car elle restera au même endroit et apparaîtra dans la navigation de votre site. La plupart des gens commencent par une page À propos qui les présente aux visiteurs potentiels du site.</p>', 'Publié', '1');
                
                INSERT INTO articles (title, slug, description, content, status, user_id)
                VALUE('Hello World', 'hello-world', 'Bienvenue sur GoSchool. Ceci est ton premier article. Edite le ou supprime le, puis commence à créer !', '<h1>Hello World !</h1><p>Bienvenue sur GoSchool. Ceci est ton premier article. Edite le ou supprime le, puis commence à créer !</p>','Publié', '1');

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
                       ('Bonjour Gael, je suis élève à l\'ESGI et je suis intéréssé par votre offre, n\'hésitez pas à me contacter à cette adresse email : alois.marcellin@myges.fr', 'Approuvé', '10', '1'),
                       ('L\'easter egg de goschool est impossible à trouver sans indice o_o, j\'ai tout essayé !', 'Approuvé', '5', '1');";

        $conn->exec($sql);
    }
}