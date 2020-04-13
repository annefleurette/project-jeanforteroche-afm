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
        <title>Billet simple pour l'Alaska - Ecrire un nouvel épisode</title>
        <meta name="description" content="L'écriture d'un nouvel épisode par Jean Forteroche">
        <script src='https://cdn.tiny.cloud/1/rusvh5uity3vzz9zncbvyfu2ngucer16rijxcr2fhxwkn4mb/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
        <script>
            tinymce.init({
            selector: '#content',
            content_css : 'style.css',
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
                        <input type="submit" name="save" value="Enregistrer">
                        <input type="submit" name="publish" value="Publier">
                    </p>
                </form>
            </section>
        <?php include("footer.php");?>
        </div>  
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>          
    </body>
</html>