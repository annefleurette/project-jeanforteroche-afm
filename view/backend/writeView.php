
<?php
$head_title = 'Billet simple pour l\'Alaska - Administration';
ob_start();
?>
<h1>Ecrire un nouvel épisode</h1>
<section id="write-episode">
    <form action="index.php?action=write_post" method="post">
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
<?php $body_content = ob_get_clean();
require('template.php');
?>