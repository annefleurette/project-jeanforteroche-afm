<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Les épisodes du roman</title>
        <meta name="description" content="Découvrez et lisez épisode par épisode le nouveau roman de Jean Forteroche, Billet simple pour l'Alaska.">
    </head>
    <body>
        <div class="container">
            <?php include("header.php");?>
            <section id="roman-episodes">
                <a href="ecrire.php" class="btn btn__CTA">Ajouter un nouvel épisode</a>
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
                    // On récupère les épisodes
                    $req = $bdd->query('SELECT episode_numero, episode_titre, episode_contenu FROM episodes ORDER BY episode_numero');
                    while ($episode_tous = $req->fetch())
                    {
                ?>
                <ul> <!-- On affiche les épisodes -->
                    <li>
                        <article>
                            <p>Episode n°<?php echo htmlspecialchars($episode_tous['episode_numero']); ?> :</p>
                            <h1><?php echo htmlspecialchars($episode_tous['episode_titre']); ?></h2>
                            <a href="episode.php?numero=<?php echo htmlspecialchars($episode_tous['episode_numero']); ?>" class="btn btn__lecture">Lire l'épisode</a>
                        </article>
                    </li>
                </ul>
                <?php
                    }
                    // Fin de la boucle des épisodes
                    $req->closeCursor();
                ?>
            </section>
            <?php include("footer.php"); ?>
        </div>
    </body>
</hmtl>