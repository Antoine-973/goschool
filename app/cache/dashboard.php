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
<body class="admin-dashboard">
    <div class="container">
        <div class="container__row">
                <aside class="container__col-2 nav-left">
                <ul>
                    <li id="logo"><a id="logo--a" href="/admin"><img src="images/logo.svg" alt="go school logo"></a></li>
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
                </aside>

        <main class="container__col-10 content">
            <nav class="nav-top">
                <ul>
                    <li><a href="/admin"><i class="fas fa-home"></i>myGES</a></li>
                    <li><a href="/admin/articles"><i class="fas fa-newspaper"></i>Créer</a></li>
                    <li><a href="/admin/medias"><i class="fas fa-user-alt"></i>Jane Doe</a></li>
                    <!-- <li><a href="/admin"><i class="fas fa-align-justify"></i></a></li> -->
                    <li><a href="/admin"><i class="fas fa-bell"></i>Notifications</a></li>
                </ul>
            </nav>
                <h1>Tableau de bord</h1>
                <div class="container content__dashboard">
                    <div class="container__row">
                        <div class="container__col-4">

                            <div class="container__row module__count">
                                <div class="container__col-6 module__class_student">
                                    <h3>Eleves</h3>
                                    <h3>1900</h3>
                                </div>

                                <div class="container__col-6 module-class_prof">
                                    <h3>Professeurs</h3>
                                    <h3>34</h3>
                                </div>
                            </div>

                            <div class="container__row module__student">
                                <div class="container__col-12">
                                    <h3>Eleves par classe</h3>
                                    <svg viewBox="0 0 32 32">
                                        <circle r="16" cx="16" cy="16" />
                                    </svg>
                                    <div class="">

                                    </div>
                                </div>
                            </div>

                            <div class="container__row module__traffic">
                                <div class="container__col-12">
                                    <table id="q-graph">
                                        <caption>Traffic du site</caption>

                                        <tbody>
                                        <tr class="qtr" id="q1">
                                            <th scope="row">Q1</th>
                                            <td class="sent bar" style="height: 111px;"><p>$18,450.00</p></td>
                                        </tr>
                                        <tr class="qtr" id="q2">
                                            <th scope="row">Q2</th>
                                            <td class="sent bar" style="height: 206px;"><p>$34,340.72</p></td>
                                        </tr>
                                        <tr class="qtr" id="q3">
                                            <th scope="row">Q3</th>
                                            <td class="sent bar" style="height: 259px;"><p>$43,145.52</p></td>
                                        </tr>
                                        <tr class="qtr" id="q4">
                                            <th scope="row">Q4</th>
                                            <td class="sent bar" style="height: 110px;"><p>$18,415.96</p></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div id="ticks">
                                        <div class="tick" style="height: 59px;"><p>2500</p></div>
                                        <div class="tick" style="height: 59px;"><p>2000</p></div>
                                        <div class="tick" style="height: 59px;"><p>1500</p></div>
                                        <div class="tick" style="height: 59px;"><p>1000</p></div>
                                        <div class="tick" style="height: 59px;"><p>500</p></div>
                                    </div>
                                </div>
                            </div>

                            <div class="container__row module__navigator">
                                <div class="container__col-12">Top 3 des navigateurs</div>
                            </div>

                        </div>

                        <div class="container__col-8">

                            <div class="container__row module-calendar">
                                <div class="container__col-12">Calendrier</div>
                            </div>

                            <div class="container__row module-event">
                                <div class="container__col-12">Evenements</div>
                            </div>

                        </div>
                    </div>
                </div>
        </main>
    </div>


</body>
</html>