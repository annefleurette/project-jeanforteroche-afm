<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Billet simple pour l'Alaska - Les épisodes du roman</title>
        <meta name="description" content="Découvrez et lisez épisode par épisode le nouveau roman de Jean Forteroche, Billet simple pour l'Alaska.">
    </head>
    <body>
        <div class="container">
            <?php include("header.php");
            if (isset($_SESSION['pseudo']) AND $_SESSION['type'] == "reader") {
            ?>
            <p>Bonjour <?php echo $_SESSION['pseudo']; ?>, content de vous revoir !</p>
            <?php
            }
            ?>
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</hmtl>