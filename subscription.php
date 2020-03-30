<?php
session_start()
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Connexion</title>
        <meta name="description" content="Inscription au blog du roman Billet simple pour l'Alaska.">
    </head>
    <body>
        <div class="container">
            <h1>Inscription</h1>
            <?php include("header.php");?>
            <section id="subscription">
                <?php
                if(!$_SESSION['pseudo']) { // 
                ?>
                <form action="subscription_post.php>" method="post">
                    <p>
                        <label for="pseudo">Pseudo</label><br />
                        <input type="text" id="pseudo" name="pseudo" minlength = "4" maxlength="20" required>
                    </p>
                    <p>
                        <label for="email">Email</label><br />
                        <input type="text" id="email" name="email" required>
                    </p>
                    <p>
                        <label for="password">Mot de passe</label><br />
                        <input type="password" id="password" name="password" required>
                    </p>
                    <p>
                        <label for="password">Confirmer le mot de passe</label><br />
                        <input type="password" id="password" name="password" required>
                    </p>
                    <p>
                        <input type="submit" value="S'inscrire">
                    </p>
                </form>
                <?php
                }else{
                ?>
                <p>Vous êtes déjà inscrit et connecté !
                <?php
                }
                ?>
            </section>
            <?php include("footer.php"); ?>
        </div>
    </body>
</html>