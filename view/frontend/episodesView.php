<?php
$head_title = 'Billet simple pour l\'Alaska - Les épisodes du roman';
$head_description = 'Découvez et lisez épisode par épisode le nouveau roman de Jean Forteroche, Billet simple pour l\'Alaska.';
ob_start();
if (isset($_SESSION['pseudo']) AND $_SESSION['type'] == "reader") {
?>
    <p>Bonjour <?php echo $_SESSION['pseudo']; ?>, content de vous revoir !</p>
<?php
}
?>
<section id="novel-episodes"> <!-- Section qui affiche tous les épisodes -->
    <h1>Billet simple pour l'Alaska</h1>
    <?php
    if($nbepisode_all > 0) { // Si des épisodes publiés existent bien
    ?>
        <ul> <!-- On affiche les épisodes -->
            <?php
            foreach ($episode_all as $episodes_all){
            ?>
                <li>
                    <article>
                        <p>Episode n°<?php echo $episodes_all['episode_number']; ?> :</p>
                        <h2><?php echo $episodes_all['episode_title']; ?></h2>
                        <a href="index.php?action=episode&amp;number=<?php echo $episodes_all['episode_number']; ?>" class="btn btn__read">Lire l'épisode</a>
                    </article>
                </li>  
            <?php
            }
            ?>
        </ul>
        <?php
        //Affichage des pages avec 3 épisodes par page
        for($pages=1 ; $pages<= $reading_pages ; $pages++){
            echo '<a href="index.php?action=episode&amp;page='. $pages . '" style="margin:2px;">' . $pages . '</a>';
            }
    }else{ // S'il n'y a pas d'épisode publié
    ?>
        <p>Jean Forteroche n'a pas encore publié d'épisode</p>
    <?php
    }
    ?>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>