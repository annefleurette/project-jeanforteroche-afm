<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
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
                    if(isset($_POST['look'])){ // Si le bouton Aperçu est choisi
                    include("header.php");?>
                        <h1><?php echo $_POST['title'];?></h1>
                        <h2>Episode n°<?php echo $_GET['number'];?></h2>
                        <p><?php echo $_POST['content'];?></p>
                        <a href="#">Retour</a>
                    <?php
                    include("footer.php");
                    } elseif(isset($_POST['save'])) { // Si le bouton Enregistrer est choisi
                        // Enregistrement de l'épisode à modifier dans la base de données
                        // Si les données ont bien été saisies
                        if (isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
                        {
                            //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
                            $look = $bdd->prepare('SELECT * FROM episodes WHERE episode_number = ? AND episode_status="published"');
                            $look->execute(array($_POST['number']));
                            $episode_result = $look->fetch();
                            $status = "inprogress";
                            if (empty($episode_result)){
                                $req = $bdd->prepare('UPDATE episodes SET episode_number = :newnumber, episode_title = :newtitle, episode_content = :newcontent, episode_status = :newstatus');
                                $req->execute(array(
                                    'newnumber' => $_POST['number'],
                                    'newtitle' => $_POST['title'],
                                    'newcontent' => $_POST['content'],
                                    'newstatus' => $status
                                ));
                                $req->closeCursor();    
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
                        if (isset($_POST['title']) AND isset($_POST['content']))
                        {
                            $status = "published";
                            $number = $_GET['number'];
                            $req = $bdd->prepare('UPDATE episodes SET episode_title = :newtitle, episode_content = :newcontent, episode_status = :newstatus WHERE episode_number = "$number"');
                                $req->execute(array(
                                    'newtitle' => $_POST['title'],
                                    'newcontent' => $_POST['content'],
                                    'newstatus' => $status
                                ));
                                $req->closeCursor();    
                                header('Location: admin.php');
                        }
                    }
                ?>
            </section>
        </div>            
    </body>
</html>