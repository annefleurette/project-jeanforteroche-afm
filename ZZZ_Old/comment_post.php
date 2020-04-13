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
        <title>Billet simple pour l'Alaska - Enregistrer le commentaire</title>
        <meta name="description" content="L'enregistrement d'un commentaire sur le roman de Jean Forteroche">
    </head>
    <body>
        <div class="container">
            <?php include("header.php");?>
            <section id="new-comment">
                <?php
                    // Connexion à la base de données
                    try
                    {
                    $bdd = new PDO('mysql:host=localhost;dbname=novel;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    }
                    catch(Exception $e)
                    {
                    die('Erreur : '.$e->getMessage());
                    }
                    // Si l'utilisateur est connecté
                if(isset($_SESSION['pseudo'])) {
                    if (isset($_POST['comment'])){ // Si le commentaire existe bien
                    $_GET['number'] = htmlspecialchars($_GET['number']);
                    $_POST['comment'] = htmlspecialchars($_POST['comment']);
                    $req_idpseudo = $bdd->prepare('SELECT id FROM members WHERE pseudo = ?'); // On récupère l'id du mmebre
                    $req_idpseudo->execute(array($_SESSION['pseudo']));
                    $exe_idpseudo = $req_idpseudo->fetch(PDO::FETCH_COLUMN);
                    $req_idepisode = $bdd->prepare('SELECT id FROM episodes WHERE episode_number = ?'); // On récupère l'id de l'épisode
                    $req_idepisode->execute(array($_GET['number']));
                    $exe_idepisode = $req_idepisode->fetch(PDO::FETCH_COLUMN);  
                    $req = $bdd->prepare('INSERT INTO comments (id_episode, id_pseudo, comment, date_comment) VALUES(?, ?, ?, NOW())');
                    $req->execute(array($exe_idepisode, $exe_idpseudo, $_POST['comment']));
                    header('Location: episode.php?number=' . $_GET['number']);
                    }   
                }else{ // Sinon renvoi vers la pages Inscription/Connexion
                    header('Location: subscription.php');
                }
                $req_idpseudo->closeCursor();
                $req_idepisode->closeCursor();
            ?>
            </section>
        </div> 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>           
    </body>
</html>