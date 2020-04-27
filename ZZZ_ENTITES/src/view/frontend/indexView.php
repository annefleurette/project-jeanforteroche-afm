<?php
$head_title = 'Billet simple pour l\'Alaska - Le dernier roman de Jean Forteroche';
$head_description = 'Billet simple pour l\'Alaska est le dernier roman de Jean Forteroche. Un homme malade explore l\'Alaska pendant le dernier mois qui lui reste à vivre.';
ob_start();
?>
<section id="novel-presentation"> <!-- Section de présentation du roman -->
    <div class="row justify-content-center no-gutters">
        <div class="novel-presentation__text col-xs-12">
            <h1>BILLET SIMPLE POUR L'ALASKA</h1>
            <p><strong>Un homme malade explore l'Alaska pendant le dernier mois qui lui reste à vivre<br />Un voyage initiatique à la découverte de soi</strong></p>
            <p class="novel-presentation__text__new">Le dernier roman de Jean Forteroche</p>
            <p><a href="index.php?action=episode&amp;number=<?php echo $episode_first['episode_number']; ?>" class="btn btn__CTA">Démarrer la lecture !</a></p>
        </div> 
    </div>                
</section>
<section id="novel-lastepisodes" class="novel-section"> <!-- Section qui regroupe les 3 derniers épisodes publiés -->
    <h2>Derniers épisodes publiés</h2>
    <hr />
    <div class="novel-episodes__list">
        <?php
        if($nbepisode_three > 0)
        {
        ?>
            <ul> <!-- On affiche les 3 derniers épisodes -->
                <?php
                foreach ($episode_three as $last_episode_three)
                {
                ?>
                    <li class="row">
                        <article class="col-md-8 col-sm-10 col-xs-12">
                            <p>Episode n°<?php echo $last_episode_three['episode_number']; ?></p>
                            <h3><?php echo $last_episode_three['episode_title']; ?></h3>
                            <a href="index.php?action=episode&amp;number=<?php echo $last_episode_three['episode_number']; ?>" class="btn btn__read">Lire l'épisode</a>
                        </article>
                    </li>
                <?php
                }
                ?>
            </ul>
        <?php
        }else{
        ?>
            <p class="episode__no">Pas d'épisode publié</p>
        <?php
        }
        ?>  
        <p><a href="index.php?action=episode" class="btn btn__CTA">Voir tous les épisodes</a></p>
    </div>
</section>
<section id="novel-author" class="novel-section"> <!-- Section qui présente l'auteur -->
    <div class="layout">
        <h2>Jean Forteroche</h2>
        <hr />
        <div class="novel-author__presentation row justify-content-center no-gutters">
            <p class="col-md-4 col-sm-10 align-self-center"><img src="./public/images/author.png" alt="Jean Forteroche"></p>
            <p class="col-md-4 col-sm-10 align-self-center">Nullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.</p>
        </div>
    </div>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>