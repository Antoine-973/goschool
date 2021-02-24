<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="cssframework/dist/main.css" />
        <title>GOSCHOOL - Connexion</title>
	</head>
	<body class="admin-login">
        <div class="container">
            <div class="container__row">
                <div class="container__col-6 connexion-leading">
                    <div class="container-leading">
                        <div class="connexion-title">
                            <h1>Bienvenue à l'école de la reussite</h1>
                        </div>

                        <div class="logo">
                            <img class="logo" src="images/logo.svg">
                        </div>
                    </div>
                    <p><small>copyright © 2021, goschool.com, tous droits réservés</small></p>
                </div>


                <div class="container__col-6 connexion-form">
                    <div class="container-form">
                        <form action="/se-connecter" method="post">
                           <div class="form-input">
                               <p><label>Adresse e-mail :</label></p>
                               <p><input type="email" class="form"></p>
                           </div>

                            <div class="form-input">
                                <p><label>Mot de passe :</label></p>
                                <p><input type="password" class="form" placeholder=""></p>
                            </div>

                            <div class="form-input">
                                <p><a href="">Mot de passe oublié</a></p>
                                <p><input type="submit" value="Se connecter" placeholder=""></p>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
	</body>
</html>