<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Ecrire un nouvel épisode</title>
        <meta name="description" content="L'écriture d'un nouvel épisode par Jean Forteroche">
    </head>
    <body>
        <div class="container">
            <section id="episode-look">
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
                // On récupère l'épisode'
                $getepisode = $bdd->prepare('SELECT episode_number, episode_title, episode_content FROM episodes WHERE id = ?');
                $getepisode ->execute(array($_GET['number']));
                $lookepisode = $getepisode->fetch();
                if (!empty($lookepisode)){
                    ?>
                    <?php include("header.php")?>
                    <h1><?php echo $lookepisode['episode_title'];?></h1>
                    <h2>Episode n°<?php echo $lookepisode['episode_number'];?></h2>
                    <p><?php echo $lookepisode['episode_content'];?></p>
                    <a href="admin.php">Retour</a>
                    <?php include("footer.php");
                }else{
                   header('Location: 404error.php'); 
                }
                    $getepisode->closeCursor();
                ?>
            </section>
        </div>            
    </body>
</html>