<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Billet simple pour l'Alaska - Inscription</title>
        <meta name="description" content="Inscription au blog du roman Billet simple pour l'Alaska.">
    </head>
    <body>
        <div class="container">
            <h1>Inscription</h1>
            <?php include("header.php");?>
            <section id="subscription">
                <?php
                if(!isset($_SESSION['pseudo'])) { //On vérifie que la personne n'est pas déjà connectée 
                ?>
                <form action="subscription_post.php" method="post">
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
                        <input type="password" id="password" name="password" min="6" required>
                    </p>
                    <p>
                        <label for="password2">Confirmer le mot de passe</label><br />
                        <input type="password" id="password2" name="password2" min="6" required>
                    </p>
                    <p>
                        <input type="submit" value="S'inscrire">
                    </p>
                </form>
                <p>Vous avez déjà un compte. <a href="login.php">Connectez-vous</a></p>
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>