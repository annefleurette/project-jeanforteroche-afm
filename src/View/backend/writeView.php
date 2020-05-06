
<?php
$head_title = 'Billet simple pour l\'Alaska - Ecrire un épisode';
ob_start();
?>

<section id="episode-write" class="write">
    <h1>Ecrire un nouvel épisode</h1>
    <form action="write_post" method="post">
        <p>
            <label for="number">Numéro de l'épisode</label><br />
            <input class="write__number" type="number" id="number" name="number" min="1" required>
        </p>
        <p>
            <label for="title">Titre de l'épisode</label><br />
            <input class="write__title" type="text" id="title" name="title" required>
        </p>
        <p>
            <label for="content">Contenu de l'épisode</label><br />
            <textarea id="content" name="content"></textarea>
        </p>
        <p class="episode-write__action">
            <input class="btn btn__read btn__prev" type="submit" name="save" value="Enregistrer">
            <input class="btn btn__read btn__next" type="submit" name="publish" value="Publier">
        </p>
    </form>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>