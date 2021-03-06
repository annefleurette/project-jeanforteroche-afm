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
        <title>Billet simple pour l'Alaska - Administration</title>
        <meta name="description" content="La plateforme d'administration sur laquelle Jean Forteroche écrit son roman Billet simple pour l'Alaska">
    </head>
    <body>
        <div class="container">
            <?php include("header.php");?>
            <section id="admin-episodes">
                <h1>Bonjour <?php echo htmlspecialchars($_SESSION['pseudo']);?></p></h1>
                <h2>Gestion des épisodes publiés</h2>
                <a href="write.php" class="btn btn__CTA">Ajouter un nouvel épisode</a>
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
                    // On récupère les épisodes publiés
                    $req = $bdd->query('SELECT episode_number, episode_title FROM episodes WHERE episode_status = "published" ORDER BY episode_number');
                    // On compte le nombre d'épisodes publiés
                    $count = $bdd->query('SELECT COUNT(*) AS numberEpisodesPublished FROM episodes WHERE episode_status = "published"');
                    $episode_published = $count->fetch();
                    $count_episode_published = intval($episode_published['numberEpisodesPublished']);
                    while ($episode_all = $req->fetch())
                    {
                        ?>
                        <ul> <!-- On affiche les épisodes publiés -->
                            <li>
                                <article>
                                    <p>Episode n°<?php echo htmlspecialchars($episode_all['episode_number']); ?> :</p>
                                    <h3><?php echo htmlspecialchars($episode_all['episode_title']); ?></h3>
                                    <ul>
                                        <!-- Lire l'épisode -->
                                        <li><a href="episode.php?number=<?php echo htmlspecialchars($episode_all['episode_number']); ?>" class="btn btn__admin">Lire</a></li>
                                        <!-- Modifier l'épisode -->
                                        <li><a href="update.php?number=<?php echo htmlspecialchars($episode_all['episode_number']); ?>" class="btn btn__admin">Modifier</a></li>
                                        <!-- Supprimer l'épisode avec demande de confirmation - On ne peut supprimer que le dernier épisode publié -->
                                        <?php
                                        if($episode_all['episode_number'] == $count_episode_published) {
                                        ?>
                                        <li><button type="button" data-toggle="modal" data-target="#Modal">Supprimer</button></li>
                                        <?php
                                        }
                                        ?>
                                    </ul> 
                                </article>
                            </li>
                        </ul>
                         <!-- Modal -->
                            <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmation de suppression</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Êtes-vous sûr(e) de vouloir supprimer cet épisode ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <a href="delete_episode.php?number=<?php echo htmlspecialchars($episode_all['episode_number']); ?>" class="btn btn__admin">Confirmer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    // Fin de la boucle des épisodes
                    $req->closeCursor();
                    $count->closeCursor();
                ?>
                <h2>Gestion des épisodes en cours</h2>
                <?php
                // On récupère les épisodes publiés
                    $req = $bdd->query('SELECT episode_number, episode_title FROM episodes WHERE episode_status = "inprogress" ORDER BY episode_number');
                    while ($episode_all = $req->fetch())
                    {
                        ?>
                        <ul> <!-- On affiche les épisodes en cours -->
                            <li>
                                <article>
                                    <p>Episode n°<?php echo htmlspecialchars($episode_all['episode_number']); ?> :</p>
                                    <h3><?php echo htmlspecialchars($episode_all['episode_title']); ?></h3>
                                    <ul>
                                        <!-- Modifier l'épisode -->
                                        <li><a href="update.php?number=<?php echo htmlspecialchars($episode_all['episode_number']); ?>" class="btn btn__admin">Modifier</a></li>
                                        <!-- Supprimer l'épisode avec demande de confirmation -->
                                        <li><button type="button" data-toggle="modal" data-target="#Modal">Supprimer</button></li>
                                    </ul> 
                                </article>
                            </li>
                        </ul>
                         <!-- Modal -->
                            <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmation de suppression</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Êtes-vous sûr(e) de vouloir supprimer cet épisode ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <a href="delete_episode.php?number=<?php echo htmlspecialchars($episode_all['episode_number']); ?>" class="btn btn__admin">Confirmer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    // Fin de la boucle des épisodes
                    $req->closeCursor();
                ?>
                <h2>Gestion des commentaires</h2>
                <?php // Récupération des commentaires
                    $comment= $bdd->query('SELECT id, id_episode, author, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM comments ORDER BY date_comment');
                        while ($comment_data = $comment->fetch()){
                            if(isset($comment_data)) {
                            ?>
                                <p>Episode n°<?php echo htmlspecialchars($comment_data['id_episode']); ?>
                                <p><?php echo htmlspecialchars($comment_data['author']); ?> le <?php echo $comment_data['date_comment_fr']; ?></p>
                                <p><?php echo nl2br(htmlspecialchars($comment_data['comment'])); ?></p>
                                <a href="delete_comment.php?number=<?php echo htmlspecialchars($comment_data['id']); ?>" class="btn btn__admin">Supprimer</a>
                            <?php
                            }
                        }
                ?>
            </section>
            <?php include("footer.php"); ?>
        </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</hmtl>