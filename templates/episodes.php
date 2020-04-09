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
            <section id="novel-episodes">
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
                    // On programme la numérotation de page
                    $pagination = $bdd->query('SELECT COUNT(*) AS numberEpisodes FROM episodes WHERE episode_status = "published"');
                    $reading = $pagination->fetch();
                    $reading_pages = ceil(($reading['numberEpisodes'])/3);
                    if (isset($_GET['page']) && ($_GET['page'] > 0))
                    {
                        $page = htmlspecialchars($_GET['page']);
                    }else{
                        $page = 1;
                    }
                    if ($page > $reading_pages) {
                        $page = $reading_pages;
                    }
                    // On récupère les épisodes
                    $req = $bdd->query('SELECT episode_number, episode_title, episode_content FROM episodes WHERE episode_status = "published" ORDER BY episode_number LIMIT '. ($page-1)*3 .',3');
                    $episode_all = $req->fetchAll();
                    $req->closeCursor();
                    $nbepisode_all = count($episode_all);
                        if($nbepisode_all > 0) {
                            foreach ($episode_all as $episodes_all){
                            ?>
                                <ul> <!-- On affiche les épisodes -->
                                    <li>
                                        <article>
                                            <p>Episode n°<?php echo $episodes_all['episode_number']; ?> :</p>
                                            <h1><?php echo $episodes_all['episode_title']; ?></h2>
                                            <a href="episode.php?number=<?php echo $episodes_all['episode_number']; ?>" class="btn btn__read">Lire l'épisode</a>
                                        </article>
                                    </li>
                                </ul>
                            <?php
                            }
                            //Affichage des pages avec 3 épisodes par page
                            for($pages=1 ; $pages<= $reading_pages ; $pages++){
                                echo '<a href="episode.php?page='. $pages . '" style="margin:2px;">' . $pages . '</a>';
                            }
                        }else{
                            ?>
                            <p>Pas d'épisode publié</p>
                            <?php
                        }
                    $pagination->closeCursor();
                ?>
            </section>
            <?php include("footer.php"); ?>
        </div>
    </body>
</hmtl>