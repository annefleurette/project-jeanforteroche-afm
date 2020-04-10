<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Episode</title>
        <meta name="description" content="Un homme malade explore l'Alaska pendant le dernier mois qui lui reste à vivre.">
    </head>
    <body>  	
    	<div class="container">
            <?php include("header.php");?>
            <section id="episode-read"> <!-- Section avec l'épisode à lire -->
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
                    // Récupération de l'épisode
                    $req = $bdd->prepare('SELECT episode_title, episode_content FROM episodes WHERE episode_number = ?');
                    $req->execute(array(htmlspecialchars($_GET['number'])));
                    $episode_unitary = $req->fetch();
                    //Récupération du nombre d'épisodes
                    $pagination = $bdd->query('SELECT COUNT(*) AS numberEpisodes FROM episodes');
                    $reading = $pagination->fetch();
                    $reading_pages = $reading['numberEpisodes'];
                    if (!empty($episode_unitary)) {
                        $episode_current = intval(htmlspecialchars($_GET['number']));
                        $episode_before = $episode_current - 1;
                        $episode_next = $episode_current + 1;
                        ?>
                        <h1>BILLET SIMPLE POUR L'ALASKA</h1>
                        <h2>Episode n°<?php echo htmlspecialchars($_GET['number']);?> : <?php echo $episode_unitary['episode_title']; ?></h2>
                        <p><?php echo $episode_unitary['episode_content']; ?></p>
                        <?php // Affichage des boutons épisodes précédents/suivants
                        if ($episode_current <= 1) {
                        ?>
                        <a href="episode.php?number=<?php echo $episode_next; ?>">Episode suivant</a>
                        <?php    
                        }else if ($episode_current >= $reading_pages){
                        ?>
                        <a href="episode.php?number=<?php echo $episode_before; ?>">Episode précédent</a>
                        <?php
                        }else{
                        ?>
                        <a href="episode.php?number=<?php echo $episode_before; ?>">Episode précédent</a>
                        <a href="episode.php?number=<?php echo $episode_next; ?>">Episode suivant</a>
                        <?php
                        }
                        ?>
                        <h2>Commentaires</h2>
                        <?php // Récupération des commentaires
                        $comment_recup = $bdd->prepare('SELECT id, author, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM comments WHERE id_episode = ? ORDER BY date_comment');
                        $comment_recup->execute(array(htmlspecialchars($_GET['number'])));
                        $comments = $comment_recup->fetchAll();
                        $comment_recup->closeCursor();
                        $nbcomments = count($comments);
                        if($nbcomments > 0) {
                            foreach ($comments as $comment_data){
                                ?>
                                <p><?php echo $comment_data['author']; ?> le <?php echo $comment_data['date_comment_fr']; ?></p>
                                <p><?php echo nl2br($comment_data['comment']); ?></p>
                                <form action="alert_post.php?id=<?php echo $comment_data['id'];?>" method="post">
                                    <input type="submit" value="Signaler">
                                </form>
                                <?php
                            }
                        }else{
                            ?>
                            <p>Pas de commentaire</p>
                            <?php     
                        } // Laisser un commentaire
                        ?>
                        <h2>Laissez un commentaire</h2>
                        <form action="comment_post.php?number=<?php echo htmlspecialchars($_GET['number']);?>" method="post">
                            <p>
                                <label for="author">Pseudo :</label><br />
                                <input type="text" id="author" name="author" minlength = "2" maxlength="255" required>
                            </p>
                            <p>
                                <label for="comment">Commentaire :</label><br />
                                <textarea id="comment" name="comment" rows="5" cols="33" minlength = "4" required></textarea>
                            </p>
                            <p>
                                <input type="submit" value="Envoyer">
                            </p>
                        </form>
                    <?php
                    }else{
                    ?>

                        <p>L'épisode que vous cherchez n'existe pas !</p>
                        <?php
                    }
                        // Fin de la requête
                        $req->closeCursor();
                        $pagination->closeCursor(); 
                    ?>
            </section>
            <?php include("footer.php");?>
        </div>
    </body>
</html>