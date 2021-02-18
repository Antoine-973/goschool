<?php class_exists('Core\Template\TemplateEngine') or exit; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="cssframework/dist/main.css" />
        <title>GOSCHOOL - Connexion</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-6">
					<div class="logoContainer">
						<img src="images/logo.svg" alt="go school logo">
						<p>Bienvenue à l’école de la réussite</p>
					</div>
				</div>
				<div class="col-6">
					<div class="row">
						<div class="col-12">
							<div class="formContainer--form white">
								<label>Adresse e-mail :</label><br>
								<input type="email" class="form"><br><br>

								<label>Mot de passe :</label><br>
								<input type="password" class="form" placeholder="*******"><br><br>

								<a href="">Mot de passe oublié</a><br><br>
								<button type="submit" class="button button--connexion">Se connecter</button>
							</div>
						</div>
						<div class="col-12">
							<div class="formContainer--contact white">
								<p>Vous n'avez pas encore de compte ?</p>
								<button type="submit" class="button button--contact">Nous contacter</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>