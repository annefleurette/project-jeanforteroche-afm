<?php
$head_title = 'Billet simple pour l\'Alaska - Lecture';
$head_description = 'Un homme malade explore l\'Alaska pendant le dernier mois qui lui reste à vivre.';
ob_start();
?>

<?php
if (!empty($episode_unitary)) {
?>
    <section id="episode-read"> <!-- Section avec l'épisode à lire -->
        <h1>BILLET SIMPLE POUR L'ALASKA</h1>
        <h2>Episode n°<?php echo htmlspecialchars($_GET['number']);?> : <?php echo $episode_unitary['episode_title']; ?></h2>
        <p><?php echo $episode_unitary['episode_content']; ?></p>
        <?php // Affichage des boutons épisodes précédents/suivants
        if($episode_current <= 1){
            if($reading_pages == 1){
            ?>
                <p>Un seul épisode publié pour le moment !</p>
            <?php  
            }else{
            ?>
                <a href="index.php?action=episode&amp;number=<?php echo $episode_next; ?>">Episode suivant</a>
            <?php 
            }   
        }elseif($episode_current >= $reading_pages){
        ?>
            <a href="index.php?action=episode&amp;number=<?php echo $episode_before; ?>">Episode précédent</a>
        <?php
        }else{
        ?>
            <a href="index.php?action=episode&amp;number=<?php echo $episode_before; ?>">Episode précédent</a>
            <a href="index.php?action=episode&amp;number=<?php echo $episode_next; ?>">Episode suivant</a>
        <?php 
        }
        ?>
    </section>
    <section id="episode-comments"> <!-- Section avec les commentaires -->
    <h2>Commentaires</h2>
    <?php
    if($nbcomments > 0) {
        foreach ($comments as $comment_data){
        ?>
            <p><?php echo $comment_data['pseudo_members']; ?> le <?php echo $comment_data['date_comment_fr']; ?></p>
            <p><?php echo nl2br($comment_data['comment_comments']); ?></p>
            <form action="alert_post.php?id=<?php echo $comment_data['id_comments'];?>" method="post">
                <input type="submit" value="Signaler">
            </form>
        <?php
        }
    }else{
    ?>
        <p>Pas de commentaire</p>
    <?php     
    }
    ?>
    <h2>Laisser un commentaire</h2>
        <?php
        if(!isset($_SESSION['pseudo'])) {
        ?>
            <p>Vous devez être connecté(e) pour laisser un commentaire. <a href="index.php?action=subscription">S'inscrire</a> ou <a href="index.php?action=login">se connecter</a>.
        <?php
        }
        ?>
        <form action="index.php?action=comment_post&amp;number=<?php echo htmlspecialchars($_GET['number']);?>" method="post">
            <p>
                <label for="comment">Commentaire :</label><br />
                <textarea id="comment" name="comment" rows="5" cols="33" minlength = "4" required></textarea>
            </p>
            <p>
                <input type="submit" value="Envoyer">
            </p>
        </form>
    </section>
<?php
}else{
?>
    <p>L'épisode que vous cherchez n'existe pas !</p>
<?php
}
$body_content = ob_get_clean();
require('template.php');
?>