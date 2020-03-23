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
        <meta name="description" content="Connexion à l'administration du roman Billet simple pour l'Alaska. Cet espace est réservé à Jean Forteroche.">
    </head>
    <body>
        <div class="container">
            <?php include("header.php");?>
            <section id="auteur-connexion">
                <?php
                if (!isset($_POST['pseudo']) OR (!isset($_POST['password']))) { // Si le pseudo ou le mot de passe n'a pas été saisi, on affiche le formulaire
                ?>
                    <form action="connexion.php" method="post">
                        <p>
                            <label for="pseudo">Identifiant :</label>
                            <input type="text" id="pseudo" name="pseudo" required>
                        </p>
                        <p>
                            <label for="password">Mot de passe :</label>
                            <input type="password" name="password" id="password" required>
                        </p>
                        <p>
                            <input type="submit" value="Se connecter">
                        </p>
                    </form>
                <?php
                }elseif ($_POST['pseudo'] != "jeanforteroche" OR $_POST['password'] != "nouveauroman" ) // Si le pseudo ou le mot de passe sont incorrects, on affiche un message d'erreur
                {
                ?>
                <p>L'identifiant ou le mot de passe est incorrect !</p>
                <form action="connexion.php" method="post">
                        <p>
                            <label for="pseudo">Identifiant :</label>
                            <input type="text" id="pseudo" name="pseudo" required>
                        </p>
                        <p>
                            <label for="password">Mot de passe :</label>
                            <input type="password" name="password" id="password" required>
                        </p>
                        <p>
                            <input type="submit" value="Se connecter">
                        </p>
                    </form>
                <?php   
                }else{ // Si le pseudo et le mot de passe sont corrects, on accès à la plateforme d'administration du roman
                $_SESSION['pseudo']= $_POST['pseudo'];
                header('Location: administration.php');    
                }
                ?>
            </section>
            <?php include("footer.php"); ?>
        </div>
    </body>
</html>