<?php
$head_title = 'Billet simple pour l\'Alaska - Administration';
ob_start();
?>
<h1 class="admin-jf">Bonjour <?php echo htmlspecialchars($_SESSION['pseudo']);?></h1>
<section id="admin-episodes">
	<h2>Gestion des épisodes</h2>
	<hr />
	<section id="admin-episodes-published" class="novel-section"> <!-- Section qui liste les épisodes publiés -->
	    <p class="new-episode"><a href="index.php?action=write" class="btn btn__CTA">Ajouter un nouvel épisode</a></p>
	    <h3>Episodes publiés</h3>
	    <?php          
	    if($nbepisode_published > 0)
	    {
	    ?>
			<div class="novel-episodes__list">
				<ul> <!-- On affiche les épisodes publiés -->
				<?php
				foreach ($published as $published_episode)
				{
				?>
					<li class="row">
						<article class="col-md-8 col-sm-10 col-xs-12">
							<p>Episode n°<?php echo $published_episode['episode_number']; ?></p>
							<h4><?php echo $published_episode['episode_title']; ?></h4>
							<ul class="novel-episodes__list__buttons">
								<!-- Lire l'épisode -->
								<li><a class="btn btn__read" href="index.php?action=episode&amp;number=<?php echo $published_episode['episode_number']; ?>" class="btn btn__admin">Lire</a></li>
								<!-- Modifier l'épisode -->
								<li><a class="btn btn__read" href="index.php?action=update_episode&amp;id=<?php echo $published_episode['id']; ?>" class="btn btn__admin">Modifier</a></li>
								<!-- Supprimer l'épisode avec demande de confirmation - On ne peut supprimer que le dernier épisode publié -->
								<?php
								if($published_episode['episode_number'] == $nbepisode_published)
								{
								?>
									<li><button class="btn btn__alert" type="button" data-toggle="modal" data-target="#Modal">Supprimer</button></li>
										<!-- Modal -->
										<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Confirmation de suppression</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<p>Êtes-vous sûr(e) de vouloir supprimer cet épisode ?</p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
														<a href="index.php?action=delete_episode&amp;id=<?php echo $published_episode['id']; ?>" class="btn btn__admin">Confirmer</a>
													</div>
												</div>
											</div>
										</div>
								<?php
								}
								?>
							</ul> 
	                	</article>
	            	</li>                
	        	<?php
	       		}
	        	?>
				</ul>
			</div>
	    <?php
	    }else{
	    ?>
	        <p class="episode__no">Pas d'épisode publié</p>
	    <?php
	    }
	    ?>
	</section>
	<section id="admin-episodes-inprogress" class="novel-section"> <!-- Section qui liste les épisodes enregistrés -->
	    <h3>Episodes en cours</h3>
	    <?php
	    if($nbepisode_inprogress > 0)
	    {
	    ?>
			<div class="novel-episodes__list">
				<ul> <!-- On affiche les épisodes en cours -->
				<?php
				foreach ($inprogress as $inprogress_episode)
				{
				?>
					<li class="row">
						<article class="col-md-8 col-sm-10 col-xs-12">
							<p>Episode n°<?php echo $inprogress_episode['episode_number']; ?></p>
							<h4><?php echo $inprogress_episode['episode_title']; ?></h4>
							<ul class="novel-episodes__list__buttons">
								<!-- Aperçu de l'épisode -->
								<li><a class="btn btn__read" href="index.php?action=look_episode&amp;id=<?php echo $inprogress_episode['id']; ?>" class="btn btn__admin">Aperçu</a></li>
								<!-- Modifier l'épisode -->
								<li><a class="btn btn__read" href="index.php?action=update_episode&amp;id=<?php echo $inprogress_episode['id']; ?>" class="btn btn__admin">Modifier</a></li>
								<!-- Supprimer l'épisode avec demande de confirmation -->
								<li><button class="btn btn__alert" type="button" data-toggle="modal" data-target="#Modal2">Supprimer</button></li>
									<!-- Modal -->
									<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Confirmation de suppression</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<p>Êtes-vous sûr(e) de vouloir supprimer cet épisode ?</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
													<a href="index.php?action=delete_episode&amp;id=<?php echo $inprogress_episode['id']; ?>" class="btn btn__admin">Confirmer</a>
												</div>
											</div>
										</div>
									</div>
							</ul> 
						</article>
					</li>
				<?php
				}
				?>
				</ul>
			</div>
	    	<?php
	    }else{
	    ?>
	        <p class="episode__no">Pas d'épisode enregistré</p>
	    <?php
	    }
	    ?>
	</section>
</section>
<section id="admin-comments">
	<h2>Gestion des commentaires</h2>
	<hr />
	<section id="admin-comments-alert" class="backoffice-block"> <!-- Section qui liste les commentaires signalés -->
		<h3>Commentaires signalés</h3>
		<?php
        if($nbcomment_published > 0)
        {
            foreach ($alert_comments as $alert_comment)
            {
            ?>
                <p>Episode n°<?php echo $alert_comment['episod_number_episodes']; ?>
                <p><?php echo $alert_comment['pseudo_members']; ?> le <?php echo $alert_comment['date_comment_fr']; ?></p>
                <p><?php echo nl2br(htmlspecialchars($alert_comment['comment_comments'])); ?></p>
                <a href="index.php?action=delete_comment&amp;id=<?php echo $alert_comment['id_comments']; ?>" class="btn btn__admin">Supprimer</a>
                <a href="index.php?action=alert_cancel&amp;id=<?php echo $alert_comment['id_comments']; ?>" class="btn btn__admin">Annuler le signalement</a>
            <?php
            }
        }else{
        ?>
            <p class="episode__no">Pas de commentaire signalé</p>
        <?php
        }  
        ?>
	</section> 
	<section id="admin-comments-global" class="backoffice-block">
		<h3>Tous les commentaires</h3>
		<?php
		if($nbcomment_published > 0)
		{
            foreach ($published_comments as $published_comment)
            {
            ?>
                <p>Episode n°<?php echo $published_comment['episod_number_episodes']; ?>
                <p><?php echo $published_comment['pseudo_members']; ?> le <?php echo $published_comment['date_comment_fr']; ?></p>
                <p><?php echo nl2br($published_comment['comment_comments']); ?></p>
                <a href="index.php?action=delete_comment&amp;id=<?php echo $published_comment['id_comments']; ?>" class="btn btn__admin">Supprimer</a>
            <?php
            }
        }else{
        ?>
            <p class="episode__no">Pas de commentaire publié</p>
        <?php
        }  
        ?>
    </section>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>