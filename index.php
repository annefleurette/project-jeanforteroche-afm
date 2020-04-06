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
                    $bdd = new PDO('mysql:host=localhost;dbname=novel;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                }
                    catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
            ?>
            <section id="novel-presentation"> <!-- Section de présentation du roman -->
                <img src="images/novel.png" alt="Billet simple pour l'Alaska">
                    <div class="novel-presentation__text">
                        <h1>BILLET SIMPLE POUR L'ALASKA</h1>
                        <p>Un homme malade explore l'Alaska pendant le dernier mois qui lui reste à vivre<br />Un voyage initiatique à la découverte de soi<br /></p>
                        <p>Le dernier roman de Jean Forteroche</p>
                        <?php
                        // On récupère le lien vers le premier épisode pour démarrer la série
                        $req = $bdd->query('SELECT episode_number FROM episodes WHERE episode_number = 1');
                        $episode_first = $req->fetch();
                        ?>
                        <a href="episode.php?number=<?php echo htmlspecialchars($episode_first['episode_number']); ?>" class="btn btn__episode1">Démarrer la lecture !</a>
                        <?php
                        // Fin de la requête du premier épisode
                        $req->closeCursor();
                        ?>
                    </div>                 
            </section>
    		<section id="novel-lastepisodes"> <!-- Section qui regroupe les 3 derniers épisodes publiés -->
                <h2>Derniers épisodes publiés</h2>
    			<div class="novel-lastepisodes__list">
                    <?php
                        // On récupère les 3 derniers épisodes
                        $req = $bdd->query('SELECT episode_number, episode_title, episode_content FROM episodes WHERE episode_status = "published" ORDER BY episode_number DESC LIMIT 0, 3');
                        $episode_three = $req->fetchAll();
                        $req->closeCursor();
                        $nbepisode_three = count($episode_three);
                        if($nbepisode_three > 0) {
                            foreach ($episode_three as $last_episode_three){
                            ?>
                                <ul> <!-- On affiche les 3 derniers épisodes -->
                                    <li>
                                        <article>
                                            <p>Episode n°<?php echo htmlspecialchars($last_episode_three['episode_number']); ?> :</p>
                                            <h3><?php echo htmlspecialchars($last_episode_three['episode_title']); ?></h3>
                                            <a href="episode.php?number=<?php echo htmlspecialchars($last_episode_three['episode_number']); ?>" class="btn btn__read">Lire l'épisode</a>
                                        </article>
                                    </li>
                                </ul>
                            <?php
                            }
                        }else{
                            ?>
                            <p>Pas d'épisode publié</p>
                            <?php
                        }
                    ?>                            
                    <a href="episode.php" class="btn btn__CTA">Voir tous les épisodes</a>
                </div>
            </section>
            <section id="novel-author"> <!-- Section qui présente l'auteur -->
                <h2>Jean Forteroche</h2>
                <img src="images/author.jpg" alt="Jean Forteroche">
                <p>Nullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.</p>
            </section>
            <?php include("footer.php"); ?>
        </div>
    </body>
</html>