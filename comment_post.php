<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
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
                    if (isset($_POST['author']) AND isset($_POST['comment'])){ // Si le pseudo et le commentaire existent bien
                    $req = $bdd->prepare('INSERT INTO comments (id_episode, author, comment, date_comment) VALUES(?, ?, ?, NOW())');
                    $req->execute(array($_GET['number'], $_POST['author'], $_POST['comment']));
                    header('Location: episode.php?number=' . $_GET['number']);
                    }   
                }else{ // Sinon renvoi vers la pages Inscription/Connexion
                    header('Location: subscription.php');
                }
            ?>
            </section>
        </div>            
    </body>
</html>