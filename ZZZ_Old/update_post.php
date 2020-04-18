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
        <title>Billet simple pour l'Alaska - Modifier l'épisode</title>
        <meta name="description" content="La modification d'un épisode par Jean Forteroche">
    </head>
    <body>
        <div class="container">
            <?php include("header.php");?>
            <section id="update-episode">
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
                    // On compte le nombre d'épisodes publiés
                    $count = $bdd->query('SELECT COUNT(*) AS numberEpisodesPublished FROM episodes WHERE episode_status = "published"');
                    $episode_published = $count->fetch();
                    $count_episode_published = intval($episode_published['numberEpisodesPublished']);
                    $count_episode_publishable = $count_episode_published + 1;
                    if(isset($_POST['save'])){   // Si le bouton Enregistrer est choisi
                        // Enregistrement de l'épisode à modifier dans la base de données
                        // Si les données ont bien été saisies
                        if (isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content'])){
                            //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
                            $look = $bdd->prepare('SELECT * FROM episodes WHERE episode_number = ? AND episode_status="published"');
                            $look->execute(array($_POST['number']));
                            $episode_result = $look->fetch();
                            $status_progress = "inprogress";
                            $_POST['number'] = htmlspecialchars($_POST['number']);
                            $_POST['title'] = htmlspecialchars($_POST['title']);
                            $_POST['content'] = htmlspecialchars($_POST['content']);
                            if (empty($episode_result)){
                                $req = $bdd->prepare('UPDATE episodes SET episode_number = :newnumber, episode_title = :newtitle, episode_content = :newcontent, episode_status = :newstatus WHERE id = :id');
                                $req->execute(array(
                                    'newnumber' => $_POST['number'],
                                    'newtitle' => $_POST['title'],
                                    'newcontent' => $_POST['content'],
                                    'newstatus' => $status_progress,
                                    'id' => htmlspecialchars($_GET['id'])
                                ));  
                                header('Location: admin.php');
                            } else {
                                ?>
                                <p>Vous avez déjà publié ce numéro d'épisode !</p>
                                <a href="admin.php">Recommencer</a>
                                <?php
                            }
                            $look->closeCursor();
                        }
                    } else { // Si le bouton Publier est choisi
                        // Enregistrement de l'épisode à publier dans la base de données
                        // Si les données ont bien été saisies
                        if (isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
                        {
                            // Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés et si ce numéro est bien le +1 du dernier épisode publié
                            $look = $bdd->prepare('SELECT * FROM episodes WHERE episode_number = ? AND episode_status="published"');
                            $look->execute(array($_POST['number']));
                            $current_episode = intval($_POST['number']);
                            $episode_result = $look->fetch();
                            $_POST['number'] = htmlspecialchars($_POST['number']);
                            $_POST['title'] = htmlspecialchars($_POST['title']);
                            $_POST['content'] = htmlspecialchars($_POST['content']);
                            $status_published = "published";
                            if (empty($episode_result) AND ($current_episode == $count_episode_publishable)){
                                $req_publish_new = $bdd->prepare('UPDATE episodes SET episode_number = :newnumber, episode_title = :newtitle, episode_content = :newcontent, episode_status = :newstatus WHERE id = :id');
                                $req_publish_new->execute(array(
                                'newnumber' => $_POST['number'],
                                'newtitle' => $_POST['title'],
                                'newcontent' => $_POST['content'],
                                'newstatus' => $status_published,
                                'id' => htmlspecialchars($_GET['id'])
                                    ));
                                header('Location: admin.php');
                            } else {
                                ?>
                                <p>Vous avez déjà publié ce numéro d'épisode ou cet épisode n'est pas le suivant du dernier épisode publié !</p>
                                <a href="admin.php">Recommencer</a>
                                <?php
                            }
                        }elseif(!isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content'])){
                            // Actualisation simple du contenu
                            $req_publish_already = $bdd->prepare('UPDATE episodes SET episode_title = :newtitle, episode_content = :newcontent WHERE id = :id');
                            $req_publish_already->execute(array(
                            'newtitle' => $_POST['title'],
                            'newcontent' => $_POST['content'],
                            'id' => htmlspecialchars($_GET['id'])
                            ));
                            header('Location: admin.php');
                        }      
                    }
                        $count->closeCursor();
                ?>
            </section>
        </div> 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>           
    </body>
</html>