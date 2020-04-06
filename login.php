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
        <meta name="description" content="Connexion à l'espace membre du roman Billet simple pour l'Alaska.">
    </head>
    <body>
        <div class="container">
        <?php
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=novel;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e)
		{
		        die('Erreur : '.$e->getMessage());
		}
        include("header.php");?>
            <section id="member-login">
                <?php
                $look = $bdd->query('SELECT pseudo, email, type FROM members');
                $look_all = $look->fetchAll();
                $look->closeCursor();
                if (!isset($_POST['pseudo']) OR (!isset($_POST['password']))) { // Si le pseudo ou le mot de passe n'a pas été saisi, on affiche le formulaire
                ?>
                    <form action="login.php" method="post">
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
                }elseif ($_POST['pseudo'] == "jeanforteroche" AND $_POST['password'] == "nouveauroman") { // Si le pseudo ou le mot de passe sont ceux de Jean Forteroche, on se connecte à l'administration
                    session_start();
                    $typesearch = $bdd->prepare('SELECT type FROM members WHERE pseudo = ?');
                    $typesearch->execute(array(htmlspecialchars($_POST['pseudo'])));
                    $resultatsearch = $typesearch->fetch();
                    $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
                    $_SESSION['type'] = $resultatsearch['type'];
                    setcookie(htmlspecialchars($_POST['pseudo']), time()+365*24*3600, null, null, false, true);
                    setcookie(htmlspecialchars($_POST['password']), time()+365*24*3600, null, null, false, true);
                    header('Location: admin.php');   
                }else{ // Traitement du cas des membres lecteurs
                    $req = $bdd->prepare('SELECT password, type FROM members WHERE pseudo = ?');
                    $req->execute(array(htmlspecialchars($_POST['pseudo'])));
                    $resultat = $req->fetch();
                    $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);
                    if(!$resultat) {
                        ?>
                        <p>Mauvais identifiant ou mot de passe</p>
                        <form action="login.php" method="post">
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
                    }else{
                        if ($isPasswordCorrect) {
                            session_start();
                            $_SESSION['pseudo'] = $_POST['pseudo'];
                            $_SESSION['type'] = $resultat['type'];
                            setcookie(htmlspecialchars($_POST['pseudo']), time()+365*24*3600, null, null, false, true);
                            setcookie(htmlspecialchars(password_verify($_POST['password'], $resultat['password'])), time()+365*24*3600, null, null, false, true);
                            header('Location: episode.php');
                        }
                        else {
                            ?>
                            <p>Mauvais identifiant ou mot de passe</p>
                            <form action="login.php" method="post">
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
                        }
                    }
                }
                ?>
            </section>
            <?php include("footer.php"); ?>
        </div>
    </body>
</html>