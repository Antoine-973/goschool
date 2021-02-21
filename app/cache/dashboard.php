<?php class_exists('Core\Template\TemplateEngine') or exit; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="cssframework/librairie/fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
    <link rel="stylesheet" href="cssframework/dist/main.css" />
    <title>GOSCHOOL - Dashboard</title>
</head>
<body>
<div class="container">
    <nav class="left">
        <ul>
            <li id="logo"><a href="/admin"><img src="images/logo.svg" alt="go school logo"></a></li>
            <li><a href="/admin"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            <li><a href="/admin/articles"><i class="fas fa-pen"></i>Articles</a></li>
            <li><a href="/admin/pages"><i class="fas fa-copy"></i></i>Pages</a></li>
            <li><a href=""><i class="fas fa-photo-video"></i>Médias</a></li>
            <li><a href=""><i class="fas fa-palette"></i>Apparence</a></li>
            <li><a href=""><i class="fas fa-graduation-cap"></i>Scolarité</a></li>
            <li><a href=""><i class="far fa-calendar-alt"></i>Planning</a></li>
            <li><a href=""><i class="fas fa-paper-plane"></i>Newsletter</a></li>
            <li><a href=""><i class="fas fa-cog"></i>Paramètre</a></li>
    
        </ul>
    </nav>
    <nav class="top">
        <ul>
            <li><a href="/admin"><i class="fas fa-home"></i>myGES</a></li>
            <li><a href="/admin/articles"><i class="fas fa-newspaper"></i>Créer</a></li>
            <li><a href="/admin/medias"><i class="fas fa-user-alt"></i>Jane Doe</a></li>
            <!-- <li><a href="/admin"><i class="fas fa-align-justify"></i></a></li> -->
            <li><a href="/admin"><i class="fas fa-bell"></i>Notifications</a></li>
        </ul>
    </nav>
</div>
</body>
</html>