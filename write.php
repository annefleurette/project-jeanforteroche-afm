<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Ecrire un nouvel épisode</title>
        <meta name="description" content="L'écriture d'un nouvel épisode par Jean Forteroche">
        <script src='https://cdn.tiny.cloud/1/rusvh5uity3vzz9zncbvyfu2ngucer16rijxcr2fhxwkn4mb/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
        <script>
            tinymce.init({
            selector: '#content',
            height: 300
            });
        </script>
    </head>
    <body>
        <div class="container">
            <?php include("header.php");?>
            <section id="write-episode">
                <h1>Ecrire un nouvel épisode</h1>
                <form action="write_post.php" method="post">
                    <p>
                        <label for="number">Numéro de l'épisode</label><br />
                        <input type="number" id="number" name="number" min="1" required>
                    </p>
                    <p>
                        <label for="title">Titre de l'épisode</label><br />
                        <input type="text" id="title" name="title" required>
                    </p>
                    <p>
                        <label for="content">Contenu de l'épisode</label><br />
                        <textarea id="content" name="content"></textarea>
                    </p>
                    <p>
                        <input type="submit" name="look" value="Aperçu">
                        <input type="submit" name="save" value="Enregistrer">
                        <input type="submit" name="publish" value="Publier">
                    </p>
                </form>
            </section>
        <?php include("footer.php");?>
        </div>            
    </body>
</html>