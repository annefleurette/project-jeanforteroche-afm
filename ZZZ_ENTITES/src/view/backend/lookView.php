<?php
$head_title = 'Billet simple pour l\'Alaska - Aperçu de l\'épisode';
ob_start();
if (!empty($lookepisode))
{
?>
    <section id="episode-look"> <!-- Section avec l'épisode en aperçu -->
        <h1>Billet simple pour l'Alaska</h1>
        <h2>Episode n°<?php echo $lookepisode['episode_number'];?> : <?php echo $lookepisode['episode_title'];?></h2>
        <p><?php echo $lookepisode['episode_content'];?></p>
        <a href="index.php?action=admin">Retour</a>
    </section>
<?php
}else{
    header('Location: index.php?action=404error');
}
$body_content = ob_get_clean();
require('template.php');
?>