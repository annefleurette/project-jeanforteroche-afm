<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Supprimer l'épisode</title>
        <meta name="description" content="La suppression d'un épisode par Jean Forteroche">
    </head>
    <body>
        <div class="container">
            <section id="delete-episode">
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
                    // On supprime l'épisode
                    $req = $bdd->prepare('DELETE FROM episodes WHERE id = ?');
                    $req->execute(array($_GET['number']));
                    header('Location: admin.php');
                ?>
            </section>
        </div>            
    </body>
</html>