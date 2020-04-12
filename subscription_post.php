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
        // Si le pseudo, l'email et les mots de passe ont bien été saisis
		if (isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['password2']))
		{
            $look_pseudo = $bdd->query('SELECT pseudo FROM members');
            $look_all_pseudo = $look_pseudo->fetchAll(PDO::FETCH_COLUMN);
            $look_pseudo->closeCursor();
            $look_email = $bdd->query('SELECT email FROM members');
            $look_all_email = $look_email->fetchAll(PDO::FETCH_COLUMN);
            $look_email->closeCursor();
            $_POST['email'] = htmlspecialchars($_POST['email']);
            $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
            // Si le pseudo est bien nouveau
            if(!in_array(strtolower($_POST['pseudo']), $look_all_pseudo) AND !in_array($_POST['email'], $look_all_email)) {
                // Si l'adresse email possède bien le bon format
                if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,}$#", $_POST['email'])) {
                    //Si le mot de passe correspond bien à sa vérification
                    if($_POST['password'] == $_POST['password2']) {
                        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $req = $bdd->prepare('INSERT INTO members (pseudo, password, email, date_subscription, type) VALUES(?, ?, ?, CURDATE(), \'reader\')');
                        $req->execute(array(htmlspecialchars($_POST['pseudo']), $pass_hache, $_POST['email']));
                        include("header.php");
                        ?>
                        <p>Votre inscription est confirmée</p>
                        <a href="login.php">Connectez-vous</a>
                        <?php
                        include("footer.php");
                        //Envoi d'un email de confirmation
                            // Le message
                                $message = "Merci, votre inscription au blog de Jean Forteroche est bien confirmée !\r\nPour se connecter : www.jeanforteroche.com";
                            // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
                                $message = wordwrap($message, 70, "\r\n");
                            // Envoi du mail
                            mail($_POST['email'], 'Confirmation d\'inscription', $message);
                    }else{
                        include("header.php");
                        ?>
                        <p>Les mots de passe ne correspondent pas</p>
                        <a href="subscription.php">Retour</a>
                        <?php
                        include("footer.php");
                    }
                }else{
                    include("header.php");
                    ?>
                    <p>Il y a une erreur dans l'adresse email</p>
                    <a href="subscription.php">Retour</a>
                    <?php
                    include("footer.php");
                }
            }else{
                include("header.php");
                ?>
                <p>Ce pseudo ou cet email est déjà utilisé</p>
                <a href="subscription.php">Retour</a>
                <?php
                include("footer.php");
            }
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>