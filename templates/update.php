<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Billet simple pour l'Alaska - Modifier un épisode</title>
        <meta name="description" content="La modification d'un épisode par Jean Forteroche">
        <script src='https://cdn.tiny.cloud/1/rusvh5uity3vzz9zncbvyfu2ngucer16rijxcr2fhxwkn4mb/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
        <script>
            tinymce.init({
            selector: '#content',
            content_css : 'style.css',
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
                $req = $bdd->prepare('SELECT episode_number, episode_title, episode_content, episode_status FROM episodes WHERE id = ?');
                    $req->execute(array(htmlspecialchars($_GET['id'])));
                    $episode_unitary = $req->fetch();
                if($episode_unitary['episode_status'] == "published"){ // Si l'épisode est un épisode déjà publié
                ?>
                <h1>Modifier l'épisode n°<?php echo $episode_unitary['episode_number']; ?></h1>
                <form action="update_post.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="post">
                    <p>
                        <label for="title">Titre de l'épisode</label><br />
                        <input type="text" id="title" name="title" value="<?php echo $episode_unitary['episode_title']; ?>" required>
                    </p>
                    <p>
                        <label for="content">Contenu de l'épisode</label><br />
                        <textarea id="content" name="content"><?php echo $episode_unitary['episode_content']; ?></textarea>
                    </p>
                    <p>
                        <input type="submit" name="publish" value="Publier">
                    </p>
                </form>
                <?php
                } elseif($episode_unitary['episode_status'] == "inprogress") { // Si l'épisode est un épisode seulement enregistré
                ?>
                <form action="update_post.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="post">
                    <p>
                        <label for="number">Numéro de l'épisode</label><br />
                        <input type="number" id="number" name="number" min="1" value="<?php echo $episode_unitary['episode_number']; ?>" required>
                    </p>
                    <p>
                        <label for="title">Titre de l'épisode</label><br />
                        <input type="text" id="title" name="title" value="<?php echo $episode_unitary['episode_title']; ?>" required>
                    </p>
                    <p>
                        <label for="content">Contenu de l'épisode</label><br />
                        <textarea id="content" name="content"><?php echo $episode_unitary['episode_content']; ?></textarea>
                    </p>
                    <p>
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>            
    </body>
</html>