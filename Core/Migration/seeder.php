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
                       ('Architecture-Logiciels','architecture-logiciels','Spécialisation'),
                       ('Mobilité-Objet-Connectés','mobilité-objet-connectés','Spécialisation'),
                       ('Ingénierie-Web','ingénierie-web','Spécialisation'),
                       ('Intelligence-Artificielle-Big-Data','intelligence-artificielle-big-data','Spécialisation'),
                       ('Ingénierie-Jeux-Vidéos','ingénierie-jeux-vidéos','Spécialisation'),
                       ('Systèmes-Réseaux','systèmes-réseaux','Spécialisation'),
                       ('Sécurité-Informatique','sécurité-informatique','Spécialisation'),
                       ('Management-Système-Information','management-système-information','Spécialisation'),
                       ('Spécialisation','spécialisation','Esgi'),
                       ('Web', 'web', NULL),
                       ('Actualité', 'actualité', NULL),
                       ('Évènement','évènement', NULL),
                       ('Général','général', NULL);

                INSERT INTO roles(role, level)
                VALUES('Big-Brother', '1'),
                ('Super-Administrateur', '2'),
                ('Administrateur', '3'),
                ('Éditeur', '4'),
                ('Auteur', '5'),
                ('Vie-Scolaire', '6'),
                ('Professeur', '7'),
                ('Élève-Rédacteur', '8'),
                ('Élève', '9'),
                ('Abonné', '10');

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
                ('crud_self_newsletter', 'Create/Update/Delete ses propres newsletter', 'Newsletter'),
                ('destruct', 'Détruire GoSchool', 'Détruire');

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
                ('1', '26'),       
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
                ('3', '2'),
                ('3', '3'),
                ('3', '4'),
                ('3', '6'),
                ('3', '7'),
                ('3', '9'),
                ('3', '10'),
                ('3', '12'),
                ('3', '13'),
                ('3', '14'),
                ('3', '15'),
                ('3', '16'),
                ('3', '17'),
                ('3', '19'),
                ('3', '20'),
                ('3', '21'),
                ('3', '22'),  
                ('3', '24'),        
                ('4', '1'),
                ('4', '5'),
                ('4', '6'),
                ('4', '7'),
                ('4', '8'),
                ('4', '9'),
                ('4', '10'),
                ('4', '13'),
                ('4', '15'),
                ('4', '16'),
                ('4', '17'),
                ('4', '22'),
                ('4', '23'),
                ('4', '24'),
                ('5', '1'),
                ('5', '6'),
                ('5', '7'),
                ('5', '11'),
                ('5', '16'),
                ('5', '17'),
                ('5', '22'),    
                ('6', '1'),
                ('6', '8'),
                ('6', '9'),
                ('6', '10'),
                ('6', '16'),
                ('6', '17'),    
                ('6', '23'),       
                ('6', '25'),    
                ('7', '1'),
                ('7', '8'),
                ('7', '11'),
                ('7', '18'),
                ('7', '23'),
                ('8', '1'),
                ('8', '8'),
                ('8', '11'),
                ('8', '18'),
                ('8', '23'),   
                ('9', '1'),
                ('9', '11'),
                ('10', '1'),
                ('10', '11');
                       
                INSERT INTO users(firstname, lastname, fullname, email, password_hash, role_id, verified)
                VALUES('Test', 'Test', 'Test Test', 'test@goschool.fr', '".password_hash('#Testo1234', PASSWORD_BCRYPT)."', '3','1'),
                ('Antoine', 'Saunier', 'Antoine Saunier', 'asaunier@goschool.fr', '".password_hash('#Test1234', PASSWORD_BCRYPT)."', '3','1'),
                ('Christian', 'Mohindo', 'Christian Mohindo', 'cmohindo@goschool.fr', '".password_hash('#Test1234', PASSWORD_BCRYPT)."', '3','1'),
                ('Calvin', 'Inthasakubol', 'Calvin Inthasakubol', 'cinthasakubol@goschool.fr', '".password_hash('#Test1234', PASSWORD_BCRYPT)."', '3','1'),
                ('John', 'Doe', 'John Doe', 'john.doe@anonymous.ru', '".password_hash('#John1234', PASSWORD_BCRYPT)."', '4','1'),
                ('Jane', 'Doe', 'Jane Doe', 'jane.doe@anonymous.ru', '".password_hash('#Jane1234', PASSWORD_BCRYPT)."', '6','1'),
                ('Gael', 'Coat', 'Gael Coat', 'gael.coat@cpassorciertechnologierecrute.fr', '".password_hash('#Gael1234', PASSWORD_BCRYPT)."', '7','1'),
                ('Tony', 'Vaucelle', 'Tony Vaucelle', 'tony.vaucelle@referencement.seo', '".password_hash('#Tony1234', PASSWORD_BCRYPT)."', '5','1'),
                ('Yves', 'Skrzypczyk', 'Yves Skrzypczyk', 'yves.skrzypczyk@yopmail.com', '".password_hash('#MonNomDeFamilleEstUnMotDePasse1', PASSWORD_BCRYPT)."', '1','1'),
                ('Alois', 'Marcellin', 'Alois Marcellin', 'alois.marcellin@myges.fr', '".password_hash('#ViveSorcierTechnologie1234', PASSWORD_BCRYPT)."', '8','1'),
                ('Pierre', 'Caillou', 'Pierre Caillou', 'pierre.laroche@dur.fr', '".password_hash('#Pierre1234', PASSWORD_BCRYPT)."', '9','1'),
                ('UnMec', 'Random', 'Unmec Random', 'unmec.random@random.fr', '".password_hash('#Random1234', PASSWORD_BCRYPT)."', '10','1');

                INSERT INTO pages (title, url, description, content, status, user_id)
                VALUES('Accueil', '/', 'La page d\'accueil du site !', '<div class=\'container\'><h1>Bienvenue à l\'école de la reussite !</h1>Pour commencer <a href=\'/admin/page/add\'>créez une page !</a> Une page À propos par exemple avec l\'url /about !<br><br>Puis <a href=\'/admin/menu/add\'>créer un menu</a> par exemple Navbar, et ajoutez-y votre page À propos !<br><br>Le thème de base de goSchool a un emplacement de menu en haut (navbar) et en bas (footer).<br><br> Pour afficher notre menu Navbar sur le site vous devez justement <a href=\'/admin/menu/position\'> modifier l\'emplacement de menu Navbar !</a><br><br>Maintenant cliquez sur le lien Accueil dans le menu, le lien devrait être le suivant : <a href=\'/about\'>À propos</a><h6>Et voilà votre première page ! À vous la gloire !</h6>Vous pouvez maintenant changer les paramètres de GoSchool pour changer notre page d\'accueil par défaut par votre magnifique nouvelle page À propos !<br><ul>Bonne découverte de GoSchool, vous pouvez essayer :<li>De créer un article qui va s\'afficher dans vos derniers articles !</li><li>De créer des utilisateurs pour votre équipe !</li><li>De créer des catégories pour vos prochains articles !</li></ul>Et surtout faites nous part de votre expérience à cette adresse email <a href=\'mailto:\'>contact.goschool@gmail.com</a><h4>Amusez vous bien !</h4></div>', 'Publié', '1'),
                ('Sample Page', '/sample-page', 'Une page d\'exemple créer par GoSchool.', '<h1>Page d\'exemple</h1><p>Ceci est une page d\'exemple. C\'est différent d\'un article car elle restera au même endroit et apparaîtra dans la navigation de votre site. La plupart des gens commencent par une page À propos qui les présente aux visiteurs potentiels du site.</p>', 'Publié', '1'),
                ('Admission', '/admission', 'Procédure d\'admission.', '<h1>ÉTAPE 1 : CANDIDATURE</h1><p>En raison des mesures prises par le gouvernement suite à la propagation du COVID-19, nous vous donnons l’opportunité de passer vos épreuves écrites et orales en ligne.</p><p>La candidature se fait en ligne ici. L’étude du dossier permet d’analyser la cohérence entre les cycles suivis par les candidats et les spécialisations qui sont proposées à l’ESGI.</p><p>Le dossier à constituer comprend :</p><blockquote><p>&gt; Une lettre de motivation<br>&gt; Un descriptif de son parcours scolaire et de ses expériences professionnelles<br>&gt; Un relevé de notes des deux dernières années d’études<br>&gt; Les photocopies des diplômes obtenus<br>&gt; Éventuellement, des lettres de soutien d’un professeur, d’un chef d’établissement ou d’un cadre de société</p></blockquote><p>Les candidats étant déclarés admissibles pour les test et l’entretien individuel de motivation devront constituer leur dossier de candidature.</p><p>NB : Il n&#39;est pas nécessaire d&#39;attendre les résultats des examens en cours de préparation pour transmettre le dossier de candidature</p><h2>ÉTAPE 2 : ADMISSION SUR TESTS ET ENTRETIEN 100% ONLINE</h2><p>Les candidats admissibles sont convoqués pour les épreuves :</p><blockquote><p>&gt; Test informatique, aptitudes générales ou anglais lié à l’année et/ou à la spécialisation choisie en ligne (ordinateur, navigateur web à jour et internet requis )<br>&gt; Un entretien individuel de motivation en visio-conférence</p></blockquote><p>Le résultat définitif est communiqué aux candidats sous quelques jours par e-mail.</p><h2>ADMISSIONS PARCOURSUP</h2><p>L’admission en cycle Bachelor sur le campus de Paris est ouverte sur Parcoursup. Pour plus d’informations, merci de contacter le Service Admission à l’adresse suivante : ADMISSIONS@ESGI.FR</p>', 'Publié', '1'),
                ('Programme', '/programme', 'Spécialisation Ingénierie du Web.', '<h1>Ingénierie du Web</h1><p>La spécialisation Ingénierie du Web forme des profils bénéficiant d’une triple compétence : l’expertise des langages de développement actuels, la gestion de projets Web complexes et sécurisés et la connaissance business.</p><p>En 3 ans, les étudiants approfondissent leur connaissance des langages et Frameworks les plus courants. Les étudiants sont capables de réaliser aussi bien le site Web statique d’une TPE / PME, que le Webservice d’un grand groupe visant à s’intégrer à plusieurs architectures existantes.</p><p>Chaque année, les étudiants obtiennent 60 crédits ECTS.</p><p>Ce cursus comprend 65 jours de cours par an.</p><h2>Cycle Bachelor 3e Année</h2><blockquote><p>Outils et environnement web<br>Docker<br>Les fondamentaux de Linux<br>Outils de versioning et pratique du code<br>Sécurité WEB<br>Serveur WEB<br><br>Technologies web et frameworks<br>Intégration WEB - HTML5 - CSS3 - jQuery<br>PHP7 - MVC From Scratch Niveau 1<br>PHP7 - Niveau avancé<br>Framework Laravel<br>Panorama des CMS<br>Développement SDK<br>Ruby On Rails</p><p><br>Analyse, conception et gestion de projet<br>Conception WEB - Figma<br>Conception de base de Données relationnelles<br>Méthodologie Agile<br><br>Outils de communication<br>Identité numérique &amp; entrepreneuriat<br>Marketing digital<br><br>Activités annuelles<br>Workshop d’ouverture<br>E-learning<br>Projet annuel<br>Programme Open ESGI et vie d’école<br>Stage ou mission en entreprise</p></blockquote><h2>Titre délivré</h2><p style=\"text-align:center;\">CHARGÉ(E) DE PROJETS EN SYSTÈMES INFORMATIQUES APPLIQUÉS<br>https://www.francecompetences.fr/recherche/rncp/27812/<br>Titre reconnu par l’État Niveau 6</p><p style=\"text-align:center;\">Arrêté du 23 février 2017 publié au Journal Officiel du 03 mars 2017 portant enregistrement au répertoire national des certifications professionnelles et délivré sous l&#39;autorité de Sciences-U Lyon CRESPA. Enregistrement pour cinq ans, au niveau 6, sous l&#39;intitulé Chargé(e) de projets en systèmes informatiques appliqués avec effet au 14 janvier 2012, jusqu&#39;au 03 mars 2022.</p><p style=\"text-align:center;\">Le titulaire du titre Chargé(e) de Projets en Systèmes Informatiques Appliqués peut intégrer le marché du travail à l’issue de sa formation. Il peut également poursuivre sur un Mastère dans la spécialisation choisie.</p>', 'Publié', '1'),
                ('Contact', '/contact', 'Nous contacter.', '<h1>Les contacts à Paris</h1><h3>SERVICE ADMISSIONS</h3><figure class=\"table\"><table><tbody><tr><td>ARNAUD PERCHE<br>Responsable des admissions</td><td>ISABELLE VIEN<br>Chargée des admissions</td></tr></tbody></table></figure><h3>DIRECTION PÉDAGOGIQUE</h3><figure class=\"table\"><table><tbody><tr><td>CHARLES-DAVID WAJNBERG<br>Directeur pédagogique<br>Intelligence artificielle et Big Data</td><td>BORIS STOCKER<br>Directeur pédagogique de la filière Management et Conseil en Systèmes d’Information</td><td>FRÉDÉRIC SANANES<br>Directeur Pédagogique<br>1re et 2e année / Architecture des Logiciels / Mobilité et Objets Connectés</td></tr></tbody></table></figure><h3>SERVICE PÉDAGOGIQUE</h3><figure class=\"table\"><table><tbody><tr><td>ELENA PARADA<br>Responsable de l’organisation<br>Responsable du Pôle Anglais</td><td>CAROLINE PLATON<br>Coordinatrice Pédagogique Mémoires<br>Open ESGI et e-learning</td><td>LUDWIG SAINT-OMER<br>Responsable de Planning<br>;</td></tr></tbody></table></figure>','Publié', '1');
                
                INSERT INTO articles (title, slug, description, content, status, user_id, categorie_id)
                VALUE('Hello World', 'hello-world', 'Hello World ! Ceci est le premier article du site !', '<h1>Hello World !</h1><p>Bienvenue sur GoSchool. Ceci est ton premier article. Edite le ou supprime le, puis commence à créer !</p>','Publié', '1', '1'),
                ('Esgi got talent 2021', 'esgi-got-talent-2021', 'A ne pas rater !', '<h1>ESGI GOT TALENT (SAISON 1) MAI 2021</h1><p>Chères étudiantes et chers étudiants,</p><p>C’est l’event de l’année! ESGI got talent saison 1 aura lieu la semaine du 17 Mai !!! Le principe ? 2 min pour dévoiler ton talent via un live sur le compte instagram du @bdeepsilon ! Pour les finalistes, des cadeaux seront mis en jeux !!</p><p><br>Pour participer, inscris-toi via le lien ci dessous !</p><p>N’hésite pas à nous contacter si tu as des questions en DM sur Instagram ou via le canal général-bde sur le serveur Discord de l’ESGI, ou sinon adresse toi directement à un membre du BDE!</p><p>On vous attend nombreux !</p><p><br>Bonne chance !</p><p><br>BDE ESPILON</p>','Publié', '1', '13'),
                ('Meetup gestion de projets agile', 'meetup-gestion-de-projets-agile', 'Les Meet-Ups, conférences organisées chaque année par les étudiants de la filière Ingénierie du Web', '<h1>La Philosophie de l’agilité</h1><p>La première partie de ce Meet-Up, présentée par Ceydric Sebbagh, comparait les méthodes de projets Cycle en V versus Agile.</p><p>Le cycle en V a longtemps été la méthode de gestion de projets utilisée au sein des entreprises.</p><p>On parle de cycle en V, ou de cascade, car le projet est découpé en plusieurs étapes qui se suivent : Définition des besoins, conception, développement, tests, application, production.</p><p>Cette méthode présente cependant plusieurs inconvénients. En effet, on part du principe que le client sait ce qu’il veut vraiment, que les développeurs savent comment le construire, et que rien ne changera durant le projet. Or la réalité est souvent différente, et dans de nombreux projets, il se trouve que la définition des besoins effectuée en début du projet ne répondent pas en réalité au réel besoin du client.</p><p>Cette approche peut cependant fonctionner pour des projets réglementaires par exemple, dans quel cas le besoin ne change que très peu.</p><p>A l’inverse, l’agilité répond à toutes ces problématiques. En effet, le principe de l’agilité est de mettre en avant l’interaction entre les personnes, la collaboration, et l’adaptation aux changements.</p><p>La méthodologie Agile fonctionne par sprint, soit par une période allant de 1 à 6 semaines selon les entreprises, durant laquelle on va définir les besoins de la période avec le client, les développer, puis livrer le produit que pourra voir le client.</p><p>En résumé, l’agilité c’est donc une organisation plus adaptable aux changements, une découverte au fur et à mesure du produit, des développements itératifs, et une réussite du projet dépendant de l’équipe entière et non plus des individus en particulier</p><h4>Le SCRUM</h4><p>La seconde partie de ce Meet-Up présentée par Adam Bouskila, avait pour but de présenter le framework SCRUM, qui est l’une des façons de travailler en agile la plus utilisée.</p><p>Cette méthode de travail innove en définissant des nouveaux rôles au sein d’une équipe :</p><p>Il y a tout d’abord Le Product Owner (PO), l’un des points centraux au suivi du projet. Responsable du produit, le PO est le client ou le représente au sein de l’équipe. Il imagine et définit les fonctionnalités du produit, récupère les feedbacks clients pour améliorer constamment le produit, priorise les travaux à réaliser par l’équipe, et communique la vision du produit à l’équipe et la marche à suivre.</p><p>Nous avons ensuite le Scrum Master, qui a pour rôle d’aider l’équipe à comprendre la théorie et la pratique Scrum, en veillant à ce qu’il n’y ait pas d’obstacles à la progression de la Scrum Team, à ce que tous les événements Scrum aient lieu, etc</p><p>Enfin, il y a les membres de la Dev Team, qui estiment les travaux, décomposent le travail à faire et développent le produit.</p><p>Scrum innove également en mettant en place un certains nombres de cérémonies, à réaliser par l’équipe entière:</p><p>● Le sprint planning, qui a pour but d’officialiser le début du sprint, et d’en fixer les objectifs et le contenu.</p><p>● Le Daily Sprint Meeting, réunion ayant lieu tous les jours une fois par jour. Durant cette réunion, chaque membre de l’équipe prend la parole pour indiquer sur quoi il a travaillé la veille, sur quoi il va travailler aujourd&#39;hui, et ses éventuels points de blocages.</p><p>● Le Sprint Review, qui se déroule à la fin de chaque Sprint, et qui a pour but de présenter les réalisations du sprint aux parties prenantes afin de récupérer du feedback client</p><p>● Le Sprint Rétrospective, qui se déroule également en fin de Sprint. Durant cette réunion, chaque membre de l’équipe prend la parole pour indiquer quels ont été les points positifs et négatifs durant le sprint précédent. Le but est de dégager des plans d’actions pour les sprints suivants pour corriger les points négatifs soulevés</p><h4>Agilité à l’échelle</h4><p>La troisième partie de ce Meet-Up présentée par Brian PLUS, avait pour but de discuter au sujet de l’agilité à l’échelle.</p><p>L’agilité à l’échelle, c’est la mise en place d’un cadre pour faire travailler plusieurs équipes agiles ensemble. Cela permet notamment de coordonner de très importants développements logiciels, d’aligner la vision, les objectifs, la capacité et l’architecture, et de garantir une qualité intrinsèque.</p><p>Il existe plusieurs frameworks permettant de faire de l’agilité à l’échelle. Cependant, les détailler ici serait trop long, mais nous pouvons cependant en citer quelques-uns, dont le SOS (Scrum of Scrum), le SAFE et le Spotify</p><p>Pour les étudiants, l’organisation de ce Meet-Up fut un vrai challenge mais aussi une belle aventure :</p><p>« Le fait d’organiser et de participer à un événement meetup nous a permis de nous rendre compte de l’avantage que peut avoir ce genre d&#39;événement, autant du côté organisateur que participant, et nous a donné l’envie de continuer à participer à ce genre d&#39;événement.</p><p>Le fait de se synchroniser avec les présentateurs a également été une expérience intéressante et enrichissante, et nous a permis de gagner encore plus en professionnalisme et en expérience.</p><p>Nous sommes donc tous satisfait de l’organisation de ce meetup, et remercions l’ESGI pour cette initiative. »</p>','Publié', '1', '13'),
                ('Atelier écriture littérature club', 'atelier-ecriture-litterature-club', 'Le club de Littérature.', '<h1>Qu&#39;est-ce qu&#39;un atelier d&#39;écriture ?</h1><p>Un atelier d&#39;écriture est un atelier où l&#39;on propose un thème d&#39;écriture aux participants,;<br>après un certain temps laissé pour écrire un petit texte (une petite histoire),<br>chacun partagera son texte à haute voix \"devant\" les autres participants. ;(ou bien le postera sur un salon dédié.)</p><p>Lors de l&#39;atelier d&#39;écriture qui aura lieu le jeudi 4 mars à 14h30 sur le salon Discord de l&#39;association,<br>quelques contraintes (que nous vous partagerons jeudi) vous seront imposées afin de donner un peu de \"challenge\".<br>Vous devrez écrire une petite histoire comprenant :<br>-Un protagoniste<br>-Un antagoniste<br>-Au minimum 300 mots</p><p>L&#39;objectif n&#39;est pas de vous transformer en écrivains mais de vous améliorer en écriture.<br>La consigne est de s&#39;aider mutuellement au niveau de l&#39;orthographe et à votre manière de rédiger.<br>Cet atelier vous permettra de vous enrichir et de faire travailler votre imagination !</p><p>Si vous voulez participer à l&#39;atelier d&#39;écriture de l&#39;association \"Littérature Club\", rejoignez-nous sur https://discord.gg/GP2XqD5<br>Pour plus d&#39;informations sur cet atelier, rejoignez le Discord de l&#39;association ou bien contactez-nous sur notre email : LitteratureClub.ESGI@gmail.com</p><p>Merci d&#39;avance,<br>Le club de Littérature.</p>','Publié', '1', '12'),
                ('Sécurité informatique', 'securite-informatique', 'Les bonnes pratiques ?', '<h1>QUELLES SONT LES PRATIQUES À RISQUE DES ENTREPRISES ?</h1><p>Depuis quelques années, les entreprises sont les cibles privilégiées des cybercriminels. Les structures professionnelles doivent augmenter leur niveau de sécurité informatique afin de se prémunir contre les menaces en ligne. Elles doivent aussi sensibiliser leurs collaborateurs afin qu’ils adoptent des comportements alertes et conscients sur le Web.</p><h3>Entreprise et sécurité informatique : quelles sont les menaces ?</h3><p>Entreprise et sécurité informatique : quelles sont les menaces ?</p><p>De nos jours, le numérique est un élément central pour une entreprise, quel que soit son secteur d’activité. Les données des sociétés sont d’ailleurs leur plus grande ressource et ont énormément de valeur, la sécurité informatique est donc un pôle de préoccupation capital pour la direction des sociétés.</p><p><br>Diminuer les risques de cyberattaques commence par la sensibilisation des équipes. Faute de connaissances dans le domaine, de nombreuses entreprises travaillent encore avec des applications numériques très peu sécurisées. Leurs collaborateurs, sans le savoir, peuvent avoir des comportements qui favorisent les cyberattaques. En effet, encore trop de sociétés ont recours à des outils bureautiques à risque, comme :</p><p><br>- Des solutions de Chat ou de visioconférence en ligne.</p><p>- L’utilisation des réseaux sociaux.</p><p>- L’accès aux applications et le stockage exclusif des données sur le Cloud.</p><p>- Des interfaces VPN peu sécurisées.</p><p>- Des outils en ligne de création de documents de travail (présentations visuelles et diaporamas).</p><p><br>En matière de sécurité informatique, la prévention est le maître-mot. La pratique courante des entreprises qui consiste à ne faire intervenir un technicien qu’en cas de cyberattaque n’est pas suffisamment viable pour mettre en place des activités professionnelles sécurisées.;</p><h3>Entreprise : comment adopter des pratiques sécuritaires en informatique ?</h3><p>Une entreprise qui souhaite augmenter son niveau de sécurité informatique doit donc adopter de nouvelles pratiques. Réduire le nombre et la diversité des appareils de travail est un premier point. Il s’agit d’ailleurs d’objets fréquemment volés, ce qui offre l’accès à leurs données au voleur. Une entreprise avisée peut demander à ses collaborateurs de n’utiliser que les postes de travail sécurisés.</p><p><br>L’usage de messageries non-professionnelles peut aussi être un facteur de risque dans l’utilisation du Web pour une entreprise. De nombreuses pratiques de phishing utilisent les messages digitaux afin d’y intégrer des virus à télécharger sous forme de pièce jointe.</p><p><br>Une entreprise doit adopter des pratiques de prévention en amont d’une attaque. Il lui faut donc confier la mise en place et la maintenance de sa sécurité informatique à un prestataire externe spécialisé. Afin de tout connaître des systèmes de sécurité numériques des entreprises, il est vivement conseillé de suivre une formation technique. À titre d’exemple, l’ESGI est l’école n°1 du génie informatique en alternance. Il est possible de se spécialiser dès la 3e année de son Programme Grande École en Sécurité Informatique et travailler ensuite comme Ingénieur sécurité ou CISO.</p><p>Les entreprises cherchent à sécuriser leur logistique sur le Web. Pour cela, elles se font épauler de consultants en sécurité informatique aguerris qui sauront créer un système spécifiquement adapté aux besoins de leur structure.</p>','Publié', '1', '12'),
                ('Ecoconception logicielle', 'ecoconception-logicielle', 'Comment s&#39;y former ?', '<h1>FOCUS MÉTIER SUR LE DÉVELOPPEUR WEB FREELANCE DEPUIS LE DÉBUT DE LA CRISE SANITAIRE</h1><p>Devenir développeur web nécessite une grande passion ainsi que des compétences très pointues dans le domaine de l’informatique et des nouvelles technologies. À l’ère de la transformation numérique, c’est un métier qui connaît un essor important et peut s’exercer en indépendant. Quelles sont les compétences requises pour devenir développeur web, et quelle formation suivre pour exercer le métier ? Pour ceux qui veulent travailler en freelance, voici quelques conseils pour débuter.</p><h4>Le métier de développeur web freelance : quel profil ?</h4><p>Le développeur web est un programmateur chargé de la conception, du développement et de l’ajustement d’un site internet et de l’ensemble des fonctionnalités qui l’accompagnent. C’est un technicien multi-tâches, multilingue et flexible qui s’adapte facilement aux besoins d’un site. Avec les enjeux de la transition numérique et l’instauration du télétravail depuis le début de la crise sanitaire, les développeurs sont actuellement très demandés sur le marché du travail. Et pour cause, ils sont responsables du bon fonctionnement d’un site internet, véritable vitrine de l’entreprise (création, mise à jour, maintenance, rapidité, etc.)</p><p><br>Le développeur web freelance travaille de façon indépendante sur différents projets, il se doit de bien cerner les besoins et les objectifs de chaque client tout en respectant le cahier des charges qui lui a été transmis. Pour mener à bien ses projets, voici les principales missions d’un développeur :</p><ol><li>L’analyse technique afin d’identifier et de comprendre les besoins détaillés du client</li><li>La conception, création et programmation de sites ou applications web</li><li>Le diagnostic et l’ajustement en cas de problèmes</li><li>Le support technique, la formation, la création d’une notice explicative et le suivi auprès du client après la livraison</li></ol><h4>Développeur web freelance : compétences et formation</h4><p>Comme tout freelance, un développeur web est un professionnel qui doit être polyvalent, autonome, à l’écoute des besoins du client tout en respectant les délais de livraison. En termes techniques, le développeur maîtrise le langage web (PHP, SQL, JAVA, etc.), CMS (systèmes de gestion de contenu) et autres logiciels de création de site web. Pour réussir et évoluer dans son métier, en plus d’être un technicien, le développeur doit faire preuve de créativité et se tenir informé des dernières actualités et évolutions régulières dans le domaine de la programmation.</p><p>Le métier de développeur web nécessite une qualification technique en informatique et exige très souvent un niveau d’étude élevé de type bac+5. Des écoles comme l’ESGI avec une spécialisation Ingénierie du Web forment des experts avec des compétences à la fois techniques et business pour répondre aux exigences de la profession.</p><p>Le métier de développeur web freelance connaît une forte demande depuis quelques années et l’explosion du digital ainsi que les effets de la crise ont particulièrement accentué cette demande. Avoir des compétences techniques solides combinées à d’excellentes qualités relationnelles et se former dans une école informatique avec une spécialisation en ingénierie du web seront de précieux atouts pour tirer son épingle du jeu.</p>','Publié', '1', '12'),
                ('Focus métier', 'focus-metier', 'Développeur freelance', '<h1>FOCUS MÉTIER SUR LE DÉVELOPPEUR WEB FREELANCE DEPUIS LE DÉBUT DE LA CRISE SANITAIRE</h1><p>Devenir développeur web nécessite une grande passion ainsi que des compétences très pointues dans le domaine de l’informatique et des nouvelles technologies. À l’ère de la transformation numérique, c’est un métier qui connaît un essor important et peut s’exercer en indépendant. Quelles sont les compétences requises pour devenir développeur web, et quelle formation suivre pour exercer le métier ? Pour ceux qui veulent travailler en freelance, voici quelques conseils pour débuter.</p><h4>Le métier de développeur web freelance : quel profil ?</h4><p>Le développeur web est un programmateur chargé de la conception, du développement et de l’ajustement d’un site internet et de l’ensemble des fonctionnalités qui l’accompagnent. C’est un technicien multi-tâches, multilingue et flexible qui s’adapte facilement aux besoins d’un site. Avec les enjeux de la transition numérique et l’instauration du télétravail depuis le début de la crise sanitaire, les développeurs sont actuellement très demandés sur le marché du travail. Et pour cause, ils sont responsables du bon fonctionnement d’un site internet, véritable vitrine de l’entreprise (création, mise à jour, maintenance, rapidité, etc.)</p><p><br>Le développeur web freelance travaille de façon indépendante sur différents projets, il se doit de bien cerner les besoins et les objectifs de chaque client tout en respectant le cahier des charges qui lui a été transmis. Pour mener à bien ses projets, voici les principales missions d’un développeur :</p><ol><li>L’analyse technique afin d’identifier et de comprendre les besoins détaillés du client</li><li>La conception, création et programmation de sites ou applications web</li><li>Le diagnostic et l’ajustement en cas de problèmes</li><li>Le support technique, la formation, la création d’une notice explicative et le suivi auprès du client après la livraison</li></ol><h4>Développeur web freelance : compétences et formation</h4><p>Comme tout freelance, un développeur web est un professionnel qui doit être polyvalent, autonome, à l’écoute des besoins du client tout en respectant les délais de livraison. En termes techniques, le développeur maîtrise le langage web (PHP, SQL, JAVA, etc.), CMS (systèmes de gestion de contenu) et autres logiciels de création de site web. Pour réussir et évoluer dans son métier, en plus d’être un technicien, le développeur doit faire preuve de créativité et se tenir informé des dernières actualités et évolutions régulières dans le domaine de la programmation.</p><p>Le métier de développeur web nécessite une qualification technique en informatique et exige très souvent un niveau d’étude élevé de type bac+5. Des écoles comme l’ESGI avec une spécialisation Ingénierie du Web forment des experts avec des compétences à la fois techniques et business pour répondre aux exigences de la profession.</p><p>Le métier de développeur web freelance connaît une forte demande depuis quelques années et l’explosion du digital ainsi que les effets de la crise ont particulièrement accentué cette demande. Avoir des compétences techniques solides combinées à d’excellentes qualités relationnelles et se former dans une école informatique avec une spécialisation en ingénierie du web seront de précieux atouts pour tirer son épingle du jeu.</p>','Publié', '1', '12');

                INSERT INTO customs (id)
                VALUE ('1');

                INSERT INTO events (title, slug, description, status, start_date, end_date, categorie_id, user_id)
                VALUE ('Soutenance Projet Annuel', 'soutenance-projet-annuel', 'Le jour de notre décès', 'Validé', '2021-07-28', '2021-07-28', '11', '6'),
                ('Speed meeting', 'speed-meeting', 'Aux jeux olympiques', 'Validé', '2021-07-30', '2021-07-30', '13', '6'),
                ('Anniversaire de Mr SKRZYPCZYK', 'anniversaire-de-mr-skrzypczyk', 'Soirée détente', 'Validé', '2021-08-05', '2021-08-05', '4', '6');

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
                       ('L\'easter egg de goschool est impossible à trouver sans indice o_o, j\'ai tout essayé !', 'Approuvé', '5', '1');
                       
              ";

        $conn->exec($sql);
    }
}