<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Modifier un épisode</title>
        <meta name="description" content="La modification d'un épisode par Jean Forteroche">
        <script src='https://cdn.tiny.cloud/1/rusvh5uity3vzz9zncbvyfu2ngucer16rijxcr2fhxwkn4mb/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
        <script>
            tinymce.init({
            selector: '#mytextarea',
            height: 300
            });
        </script>
    </head>
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
    ?>
    <body>
        <div class="container">
            <?php include("header.php");?>
            <section id="update-episode">
                <?php  
                $req = $bdd->prepare('SELECT episode_title, episode_content, episode_status FROM episodes WHERE episode_number = ?');
                    $req->execute(array($_GET['number']));
                    $episode_unitary = $req->fetch();
                    $episode_number_update = intval($_GET['number']);
                if($episode_unitary['episode_status'] == "published"){
                ?>
                <h1>Modifier l'épisode n°<?php echo $_GET['number'];?></h1>
                <form action="update_post.php" method="post">
                    <p>
                        <label for="title">Titre de l'épisode</label><br />
                        <input type="text" id="title" name="title" value="<?php echo $episode_unitary['episode_title']; ?>" required>
                    </p>
                    <p>
                        <label for="content">Contenu de l'épisode</label><br />
                        <textarea id="content" name="content" required><?php echo $episode_unitary['episode_content']; ?></textarea>
                    </p>
                    <p>
                        <input type="submit" name="look" value="Aperçu">
                        <input type="submit" name="publish" value="Publier">
                    </p>
                </form>
                <?php
                } else {
                ?>
                <form action="update_post.php" method="post">
                    <p>
                        <label for="number">Numéro de l'épisode</label><br />
                        <input type="number" id="number" name="number" min="1" value="<?php echo $episode_number_update; ?>" required>
                    </p>
                    <p>
                        <label for="title">Titre de l'épisode</label><br />
                        <input type="text" id="title" name="title" value="<?php echo $episode_unitary['episode_title']; ?>" required>
                    </p>
                    <p>
                        <label for="content">Contenu de l'épisode</label><br />
                        <textarea id="content" name="content" required><?php echo $episode_unitary['episode_content']; ?></textarea>
                    </p>
                    <p>
                        <input type="submit" name="look" value="Aperçu">
                        <input type="submit" name="save" value="Enregistrer">
                        <input type="submit" name="publish" value="Publier">
                    </p>
                </form>
                <?php
                }
                ?>
            <?php
            // Fin de la requête
            $req->closeCursor();
            include("footer.php");
            ?>
            </section>
        </div>            
    </body>
</html>