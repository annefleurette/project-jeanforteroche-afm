<?php
$head_title = 'Billet simple pour l\'Alaska - Lecture';
$head_description = 'Un homme malade explore l\'Alaska pendant le dernier mois qui lui reste à vivre.';
ob_start();
if (!empty($episode_unitary_published))
{
?>
    <section id="episode-read"> <!-- Section avec l'épisode à lire -->
        <h1>Billet simple pour l'Alaska</h1>
        <h2>Episode n°<?php echo $getnumber;?> : <?php echo $episode_unitary_published['episode_title']; ?></h2>
        <hr />
        <div class="row justify-content-center no-gutters">
            <div class="col-md-8 col-sm-10 col-xs-12">
                <div class="episode-read__content"><?php echo $episode_unitary_published['episode_content']; ?></div>
                <?php // Affichage des boutons épisodes précédents/suivants
                if($episode_current <= 1)
                {
                    if($nbepisodes == 1)
                    {
                    ?>
                        <div class="episode-read__pagination">Un seul épisode publié pour le moment !</div>
                    <?php  
                    }else{
                    ?>
                        <div class="episode-read__pagination"><a class="btn btn__read" href="index.php?action=episode&amp;number=<?php echo $episode_next; ?>">Episode suivant</a><div>
                    <?php 
                    }   
                }elseif($episode_current >= $nbepisodes)
                {
                ?>
                    <div class="episode-read__pagination"><a class="btn btn__read" href="index.php?action=episode&amp;number=<?php echo $episode_before; ?>">Episode précédent</a></div>
                <?php
                }else{
                ?>
                    <div class="btn__together episode-read__pagination">
                        <a class="btn btn__read btn__prev" href="index.php?action=episode&amp;number=<?php echo $episode_before; ?>">Episode précédent</a>
                        <a class="btn btn__read btn__next" href="index.php?action=episode&amp;number=<?php echo $episode_next; ?>">Episode suivant</a>
                    </div>
                <?php 
                }
                ?>
            </div>
        </div>
    </section>
    <section id="episode-comments" class="novel-section"> <!-- Section avec les commentaires -->
    <h2>Commentaires</h2>
    <hr />
    <?php
    if($nbcomments > 0)
    {
    ?>
        <ul> <!-- On affiche les commentaires -->
            <?php
            foreach ($comments as $comment_data)
            {
            ?>
                <li class="row justify-content-center no-gutters">
                    <article class="col-md-8 col-sm-10 col-xs-12">
                        <p><strong><?php echo $comment_data['pseudo_members']; ?></strong> le <?php echo $comment_data['date_comment_fr']; ?></p>
                        <p><?php echo nl2br($comment_data['comment_comments']); ?></p>
                        <form action="index.php?action=alert_post&amp;id=<?php echo $comment_data['id_comments'];?>" method="post">
                            <input class="btn btn__alert" type="submit" value="Signaler">
                        </form>
                    </article>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    }else{
    ?>
        <p class="data__no">Pas de commentaire</p>
    <?php     
    }
    ?>
    <h2>Laisser un commentaire</h2>
    <hr />
        <?php
        if(!isset($_SESSION['pseudo']))
        {
        ?>
            <p class="data__no">Vous devez être connecté(e) pour laisser un commentaire. <a href="index.php?action=subscription">S'inscrire</a> ou <a href="index.php?action=login">se connecter</a>.</p>
        <?php
        }else{
        ?>
            <form class="post-comment" action="index.php?action=comment_post&amp;number=<?php echo $getnumber;?>" method="post">
                <p>
                    <label for="comment">Saisissez votre commentaire</label><br />
                    <textarea id="comment" name="comment" minlength = "4" required></textarea>
                </p>
                <p>
                    <input class="btn btn__CTA" type="submit" value="Envoyer">
                </p>
            </form>
        <?php
        }
        ?>
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