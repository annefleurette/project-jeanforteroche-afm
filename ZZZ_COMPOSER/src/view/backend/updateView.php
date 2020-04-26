<?php
$head_title = 'Billet simple pour l\'Alaska - Modifier un épisode';
ob_start();
?>
<section id="update-episode">
    <?php
    if($episode_unitary['episode_status'] == "published")
    { // Si l'épisode est un épisode déjà publié
    ?>
        <h1>Modifier l'épisode n°<?php echo $episode_unitary['episode_number']; ?></h1>
        <form action="index.php?action=update_post&amp;id=<?php echo htmlspecialchars($_GET['id']); ?>" method="post">
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
    }elseif($episode_unitary['episode_status'] == "inprogress")
    { // Si l'épisode est un épisode seulement enregistré
    ?>
        <h1>Modification de l'épisode</h1>
        <form action="index.php?action=update_post&amp;id=<?php echo htmlspecialchars($_GET['id']); ?>" method="post">
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
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>