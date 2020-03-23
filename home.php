<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Le dernier roman de Jean Forteroche</title>
        <meta name="description" content="Billet simple pour l'Alaska est le dernier roman de Jean Forteroche. Un homme malade explore l'Alaska pendant le dernier mois qui lui reste à vivre.">
    </head>
    <body>  	
    	<div class="container">
            <?php include("header.php");
                // Connexion à la base de données
                try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=roman;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                }
                    catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
            ?>
            <section id="roman-presentation"> <!-- Section de présentation du roman -->
                <img src="images/roman.png" alt="Billet simple pour l'Alaska">
                    <div class="roman-presentation__texte">
                        <h1>BILLET SIMPLE POUR L'ALASKA</h1>
                        <p>Un homme malade explore l'Alaska pendant le dernier mois qui lui reste à vivre<br />Un voyage initiatique à la découverte de soi<br /></p>
                        <p>Le dernier roman de Jean Forteroche</p>
                        <?php
                        // On récupère le lien vers le premier épisode pour démarrer la série
                        $req = $bdd->query('SELECT episode_numero FROM episodes WHERE episode_numero = 1');
                        $episode_premier = $req->fetch()
                        ?>
                        <a href="lecture.php?episode=<?php echo htmlspecialchars($episode_premier['episode_numero']); ?>" class="btn btn__episode1">Démarrer la lecture !</a>
                        <?php
                        // Fin de la requête du premier épisode
                        $req->closeCursor();
                        ?>
                    </div>                 
            </section>
    		<section id="roman-lastepisodes"> <!-- Section qui regroupe les 3 derniers épisodes publiés -->
                <h2>Derniers épisodes publiés</h2>
    			<div class="roman-lastepisodes__liste">
                    <?php
                        // On récupère les 3 derniers épisodes
                        $req = $bdd->query('SELECT episode_numero, episode_titre, episode_contenu FROM episodes ORDER BY episode_numero DESC LIMIT 0, 3');
                        while ($episode_trois = $req->fetch())
                        {
                    ?>
                    <ul> <!-- On affiche les 3 derniers épisodes -->
                        <li>
                            <article>
                                <p>Episode n°<?php echo htmlspecialchars($episode_trois['episode_numero']); ?> :</p>
                                <h3><?php echo htmlspecialchars($episode_trois['episode_titre']); ?></h3>
                                <a href="episode.php?numero=<?php echo htmlspecialchars($episode_trois['episode_numero']); ?>" class="btn btn__lecture">Lire l'épisode</a>
                            </article>
                        </li>
                    </ul>
                    <?php
                        }
                        // Fin de la boucle des épisodes
                        $req->closeCursor();
                    ?>
                                            
                    <a href="lecture.php" class="btn btn__CTA">Voir tous les épisodes</a>
                </div>
            </section>
            <section id="roman-auteur"> <!-- Section qui présente l'auteur -->
                <h2>Jean Forteroche</h2>
                <img src="images/auteur.jpg" alt="Jean Forteroche">
                <p>Nullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.</p>
            </section>
            <?php include("footer.php"); ?>
        </div>
    </body>
</html>