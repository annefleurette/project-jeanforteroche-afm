
<?php $head_title = 'Billet simple pour l\'Alaska - Le dernier roman de Jean Forteroche'; ?>
<?php $head_description = 'Billet simple pour l\'Alaska est le dernier roman de Jean Forteroche. Un homme malade explore l\'Alaska pendant le dernier mois qui lui reste à vivre.'; ?>

<?php ob_start(); ?>
    <section id="novel-presentation"> <!-- Section de présentation du roman -->
        <img src="images/novel.png" alt="Billet simple pour l'Alaska">
        <div class="novel-presentation__text">
            <h1>BILLET SIMPLE POUR L'ALASKA</h1>
            <p>Un homme malade explore l'Alaska pendant le dernier mois qui lui reste à vivre<br />Un voyage initiatique à la découverte de soi<br /></p>
            <p>Le dernier roman de Jean Forteroche</p>
            <?php
            // On récupère le lien vers le premier épisode pour démarrer la série
            ?>
            <a href="episode.php?action=listEpisodeFirst&amp;number=<?php echo htmlspecialchars($episode_first['episode_number']); ?>" class="btn btn__episode1">Démarrer la lecture !</a>
            <?php
            // Fin de la requête du premier épisode
            $req->closeCursor();
            ?>
        </div>                 
    </section>
    <section id="novel-lastepisodes"> <!-- Section qui regroupe les 3 derniers épisodes publiés -->
        <h2>Derniers épisodes publiés</h2>
        <div class="novel-lastepisodes__list">
            <?php
            // On affiche les 3 derniers épisodes
            $nbepisode_three = count($episode_three);
            if($nbepisode_three > 0) {
                foreach ($episode_three as $last_episode_three){
                ?>
                    <ul> <!-- On affiche les 3 derniers épisodes -->
                        <li>
                            <article>
                                <p>Episode n°<?php echo $last_episode_three['episode_number']; ?> :</p>
                                <h3><?php echo $last_episode_three['episode_title']; ?></h3>
                                <a href="episode.php?action=listEpisodesLastThre&amp;number=<?php echo $last_episode_three['episode_number']; ?>" class="btn btn__read">Lire l'épisode</a>
                            </article>
                        </li>
                    </ul>
                <?php
                $req->closeCursor();
                }
            }else{
                ?>
                <p>Pas d'épisode publié</p>
            <?php
            }
            ?>                            
            <a href="episode.php" class="btn btn__CTA">Voir tous les épisodes</a>
        </div>
    </section>
    <section id="novel-author"> <!-- Section qui présente l'auteur -->
        <h2>Jean Forteroche</h2>
        <img src="images/author.jpg" alt="Jean Forteroche">
        <p>Nullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.</p>
    </section>
<?php $body_content = ob_get_clean(); ?>
<?php require('frontend/template.php'); ?>
