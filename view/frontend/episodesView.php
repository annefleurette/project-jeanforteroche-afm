<?php $head_title = 'Billet simple pour l\'Alaska - Les épisodes du roman'; ?>
<?php $head_description = 'Découvrez et lisez épisode par épisode le nouveau roman de Jean Forteroche, Billet simple pour l\'Alaska.'; ?>

<?php ob_start(); ?>
<?php if (isset($_SESSION['pseudo']) AND $_SESSION['type'] == "reader") {
?>
<p>Bonjour <?php echo $_SESSION['pseudo']; ?>, content de vous revoir !</p>
<?php
}
?>
<section id="novel-episodes">
    <?php
    // On vérifie s'il y a des épisodes ou pas
    $req->closeCursor();
    if(empty($check_result)){
        ?>
        <p>Jean Forteroche n'a pas encore publié d'épisode de son roman Billet pour l'Alaska</p>
        <?php
    }else{
        // On programme la numérotation de page
        if (isset($_GET['page']) && ($_GET['page'] > 0))
        {
            $page = htmlspecialchars($_GET['page']);
        }else{
            $page = 1;
        }
        if ($page > $reading_pages) {
        $page = $reading_pages;
        }
        // On récupère les épisodes
        $req->closeCursor();
        if($nbepisode_all > 0) {
            foreach ($episode_all as $episodes_all){
            ?>
            <ul> <!-- On affiche les épisodes -->
                <li>
                    <article>
                        <p>Episode n°<?php echo $episodes_all['episode_number']; ?> :</p>
                        <h1><?php echo $episodes_all['episode_title']; ?></h2>
                        <a href="episode.php?number=<?php echo $episodes_all['episode_number']; ?>" class="btn btn__read">Lire l'épisode</a>
                    </article>
                </li>
            </ul>
            <?php
            }
            //Affichage des pages avec 3 épisodes par page
            for($pages=1 ; $pages<= $reading_pages ; $pages++){
                echo '<a href="episode.php?page='. $pages . '" style="margin:2px;">' . $pages . '</a>';
            }
        }else{
            ?>
            <p>Pas d'épisode publié</p>
            <?php
        }
    $pagination->closeCursor();
    }
    ?>
</section>
<?php $body_content = ob_get_clean(); ?>
<?php require('frontend/template.php'); ?>