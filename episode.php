<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Episodes</title>
        <meta name="description" content="Un homme malade explore l'Alaska pendant le dernier mois qui lui reste à vivre.">
    </head>
    <body>  	
    	<div class="container">
            <?php include("header.php");?>
            <section id="episode-lecture"> <!-- Section avec l'épisode à lire -->
                <?php
                    // Connexion à la base de données
                    try
                    {
                        $bdd = new PDO('mysql:host=localhost;dbname=roman;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    }
                        catch(Exception $e)
                    {
                        die('Erreur : '.$e->getMessage());
                    }
                    // Récupération de l'épisode
                    $req = $bdd->prepare('SELECT episode_titre, episode_contenu FROM episodes WHERE episode_numero = ?');
                    $req->execute(array($_GET['numero']));
                    $episode_unitaire = $req->fetch();
                    if (!empty($episode_unitaire)) {
                        /* $episode_actuel = $_GET['numero'];
                        $episode_precedent = $episode_actuel - 1;
                        $episode_suivant = $episode_actuel + 1;*/
                        ?>
                        <h1>BILLET SIMPLE POUR L'ALASKA</h1>
                        <h2>Episode n°<?php echo $_GET['numero']?> : <?php htmlspecialchars($episode_unitaire['episode_titre']); ?></h2>
                        <p><?php echo htmlspecialchars($episode_unitaire['episode_contenu']);?></p>
                        <!--  <a href="episode.php?numero=<?php echo $episode_precedent; ?>">Episode précédent</a>
                        <a href="episode.php?numero=<?php echo $episode_suivant; ?>">Episode suivant</a> -->
                        <h2>Commentaires</h2>
                        <p>A venir...</p>
                        <?php
                    }else{
                        ?>
                        <p>L'épisode que vous cherchez n'existe pas !</p>
                        <?php
                    }
                        // Fin de la requête
                        $req->closeCursor();
                    ?>
            </section>
            <?php include("footer.php");?>
        </div>
    </body>
</html>