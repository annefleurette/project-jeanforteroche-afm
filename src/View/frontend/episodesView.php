<?php
$head_title = 'Billet simple pour l\'Alaska - Les épisodes du roman';
$head_description = 'Découvez et lisez épisode par épisode le nouveau roman de Jean Forteroche, Billet simple pour l\'Alaska.';
ob_start();
?>
<section id="novel-episodes" class="novel-section"> <!-- Section qui affiche tous les épisodes -->
    <h1>BILLET SIMPLE POUR L'ALASKA</h1>
    <h2>Tous les épisodes publiés</h2>
    <hr />
    <?php    
    if (isset($_SESSION['pseudo']) AND $_SESSION['type'] == "reader") {
    ?>
        <p class="novel-episodes__welcome">Bonjour <strong><?php echo $_SESSION['pseudo']; ?></strong>, content de vous revoir !</p>
    <?php
    }
    if(empty($nbepisodes))
    { // S'il n'y a pas d'épisode publié
    ?>
        <p class="data__no">Jean Forteroche n'a pas encore publié d'épisode</p>
    <?php
    }else{
    // Si des épisodes publiés existent bien
    ?>
        <div class="novel-episodes__list">
            <ul> <!-- On affiche les épisodes -->
                <?php
                foreach ($episode_all as $episodes_all){
                ?>
                    <li class="row">
                        <article class="col-md-8 col-sm-10 col-xs-12">
                            <p>Episode n°<?php echo $episodes_all['episode_number']; ?></p>
                            <h3><?php echo $episodes_all['episode_title']; ?></h3>
                            <a href="episode/number-<?php echo $episodes_all['episode_number']; ?>" class="btn btn__read">Lire l'épisode</a>
                        </article>
                    </li>  
                <?php
                }
                ?>
            </ul>
            <p class="novel-episodes__list__pagination">
                <?php
                //Affichage des pages avec 3 épisodes par page
                for($pages=1 ; $pages<= $reading_pages ; $pages++)
                {
                ?>
                    <a href="episode/page-<?php echo $pages; ?>" style="margin:2px;"><?php echo $pages; ?></a>
                <?php
                }
                ?>
            </p>
        </div>
    <?php
    } 
    ?>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>