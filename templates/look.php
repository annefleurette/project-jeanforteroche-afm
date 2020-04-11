<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Billet simple pour l'Alaska - Aperçu</title>
        <meta name="description" content="L'aperçu d'un nouvel épisode par Jean Forteroche">
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    </body>
</html>