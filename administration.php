<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Administration</title>
        <meta name="description" content="La plateforme d'administration sur laquelle Jean Forteroche écrit son roman Billet simple pour l'Alaska">
    </head>
    <body>
        <div class="container">
            <?php include("header.php");?>
            <section id="administration-episodes">
                <h1>Bonjour <?php echo htmlspecialchars($_SESSION['pseudo']);?></p></h1>
                <h2>Gestion des épisodes</h2>
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
                    $req = $bdd->query('SELECT episode_numero, episode_titre FROM episodes ORDER BY episode_numero');
                    while ($episode_tous = $req->fetch())
                    {
                ?>
                <ul> <!-- On affiche les épisodes -->
                    <li>
                        <article>
                            <p>Episode n°<?php echo htmlspecialchars($episode_tous['episode_numero']); ?> :</p>
                            <h3><?php echo htmlspecialchars($episode_tous['episode_titre']); ?></h3>
                            <ul>
                                <li><a href="episode.php?numero=<?php echo htmlspecialchars($episode_tous['episode_numero']); ?>" class="btn btn__administration">Lire</a></li>
                                <li><a href="modifier.php?numero=<?php echo htmlspecialchars($episode_tous['episode_numero']); ?>" class="btn btn__administration">Modifier</a></li>
                                <li><a href="supprimer.php?numero=<?php echo htmlspecialchars($episode_tous['episode_numero']); ?>" class="btn btn__administration">Supprimer</a></li>
                            </ul>   
                        </article>
                    </li>
                </ul>
                <?php
                    }
                    // Fin de la boucle des épisodes
                    $req->closeCursor();
                ?>
                <h2>Gestion des commentaires</h2>
                <p>A venir...</p>
            </section>
            <?php include("footer.php"); ?>
        </div>
    </body>
</hmtl>