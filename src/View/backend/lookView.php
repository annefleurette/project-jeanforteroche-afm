<?php
$head_title = 'Billet simple pour l\'Alaska - Aperçu de l\'épisode';
ob_start();
if (!empty($lookepisode))
{
?>
    <section id="episode-look"> <!-- Section avec l'épisode en aperçu -->
        <h1>Billet simple pour l'Alaska</h1>
        <h2>Episode n°<?php echo $lookepisode['episode_number'];?> : <?php echo $lookepisode['episode_title'];?></h2>
        <hr />
        <div class="row justify-content-center no-gutters">
            <div class="col-md-8 col-sm-10 col-xs-12">
                <div class="episode-read__content"><?php echo $lookepisode['episode_content'];?></div>
                <div class="episode-look__back">
                    <a class="btn btn__read" href="index.php?action=admin">Retour</a>
                </div>
            </div>
        </div>
    </section>
<?php
}else{
?>
    <section id="error404">
        <h1>Erreur 404</h1>
        <p class="data__no page__no">Cette page n'existe pas !</p>
    </section>
<?php
}
$body_content = ob_get_clean();
require('template.php');
?>