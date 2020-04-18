<?php
session_start()
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
                if (!isset($_POST['email']) OR (!isset($_POST['password']))) { // Si le pseudo ou le mot de passe n'a pas été saisi, on affiche le formulaire
                ?>
                    <form action="login.php" method="post">
                        <p>
                            <label for="email">Identifiant email :</label>
                            <input type="text" id="email" name="email" required>
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
                }else{ // Traitement du cas des membres inscrits
                    $req = $bdd->prepare('SELECT pseudo, password, type FROM members WHERE email = ?');
                    $req->execute(array(htmlspecialchars($_POST['email'])));
                    $resultat = $req->fetch();
                    $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);
                    if(!$resultat){
                        ?>
                        <p>Mauvais identifiant ou mot de passe</p>
                        <form action="login.php" method="post">
                                <p>
                                    <label for="email">Identifiant email :</label>
                                    <input type="text" id="email" name="email" required>
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
                        if ($isPasswordCorrect){
                            session_start();
                            $_SESSION['pseudo'] = $resultat['pseudo'];
                            $_SESSION['type'] = $resultat['type'];
                            setcookie(htmlspecialchars($_POST['email']), time()+365*24*3600, null, null, false, true);
                            setcookie(htmlspecialchars(password_verify($_POST['password'], $resultat['password'])), time()+365*24*3600, null, null, false, true);
                            if($resultat['type'] == "admin"){ // Si le membre est admin
                                header('Location: admin.php'); 
                            }else{ // Si le membre est reader
                                header('Location: episode.php');
                            }
                        }else{
                            ?>
                            <p>Mauvais identifiant ou mot de passe</p>
                            <form action="login.php" method="post">
                                <p>
                                    <label for="email">Identifiant email :</label>
                                    <input type="text" id="email" name="email" required>
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>