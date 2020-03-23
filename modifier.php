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
            <section id="modifier-episode">
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
                    // On modifie l'épisode
                    $req = $bdd->prepare('UPDATE episodes SET episode_numero = :nvnumero, episode_titre = :nvtitre, episode_contenu = :nvcontenu');
                    /*$req->execute(array(
                        'xxxx' => $nvnumero,
                        'xxxx' => $nvtitre,
                        'xxxx' => $nvtcontenu ));*/
                ?>
            </section>
        </div>            
    </body>
</html>