<?php
$head_title = 'Billet simple pour l\'Alaska - Administration';
ob_start();
?>
<h1 class="admin-jf">Bonjour <?php echo htmlspecialchars($_SESSION['pseudo']);?></h1>
<section id="admin-episodes">
	<h2>Gestion des épisodes</h2>
	<hr />
	<section id="admin-episodes-published" class="novel-section"> <!-- Section qui liste les épisodes publiés -->
		<div id="admin-episodes-published__flag"></div>
		<h3>Episodes publiés</h3>
		<p class="new-episode"><a href="write" class="btn btn__CTA btn__SizePlus"><i class="fas fa-plus"></i> Ajouter un nouvel épisode</a></p>
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
								<li><a class="btn btn__read btn__top" href="episode/number-<?php echo $published_episode['episode_number']; ?>" class="btn btn__admin">Lire</a></li>
								<!-- Modifier l'épisode -->
								<li><a class="btn btn__read btn__middle" href="update_episode/<?php echo $published_episode['id']; ?>" class="btn btn__admin">Modifier</a></li>
								<!-- Supprimer l'épisode avec demande de confirmation - On ne peut supprimer que le dernier épisode publié -->
								<?php
								if($published_episode['episode_number'] == $nbepisode_published)
								{
								?>
									<li><button class="btn btn__alert btn__bottom" type="button" data-toggle="modal" data-target="#Modal">Supprimer</button></li>
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
														<button type="button" class="btn btn__no" data-dismiss="modal">Annuler</button>
														<a href="delete_episode/<?php echo $published_episode['id']; ?>" class="btn btn__ok">Confirmer</a>
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
	        <p class="data__no">Pas d'épisode publié</p>
	    <?php
	    }
	    ?>
	</section>
	<section id="admin-episodes-inprogress" class="novel-section"> <!-- Section qui liste les épisodes enregistrés -->
		<div id="admin-episodes-inprogress__flag"></div>
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
								<li><a class="btn btn__read btn__width-fixed__episodes btn__top" href="look_episode/<?php echo $inprogress_episode['id']; ?>" class="btn btn__admin">Aperçu</a></li>
								<!-- Modifier l'épisode -->
								<li><a class="btn btn__read btn__width-fixed__episodes btn__middle" href="update_episode/<?php echo $inprogress_episode['id']; ?>" class="btn btn__admin">Modifier</a></li>
								<!-- Supprimer l'épisode avec demande de confirmation -->
								<li><button class="btn btn__alert btn__bottom" type="button" data-toggle="modal" data-target="#Modal2">Supprimer</button></li>
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
													<button type="button" class="btn btn__no" data-dismiss="modal">Annuler</button>
													<a href="delete_episode/<?php echo $inprogress_episode['id']; ?>" class="btn btn__ok">Confirmer</a>
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
	        <p class="data__no">Pas d'épisode enregistré</p>
	    <?php
	    }
	    ?>
	</section>
</section>
<section id="admin-comments">
	<h2>Gestion des commentaires</h2>
	<hr />
	<section id="admin-comments-alert" class="novel-section"> <!-- Section qui liste les commentaires signalés -->
		<div id="admin-comments-alert__flag"></div>
		<h3>Commentaires signalés</h3>
		<?php
        if($nbcomment_published > 0)
        {
		?>
			<ul> 
				<?php
				foreach ($alert_comments as $alert_comment)
				{
				?>
					<li class="row justify-content-center no-gutters">
						<article class="col-md-8 col-sm-10 col-xs-12">
							<p>Episode n°<?php echo $alert_comment['episod_number_episodes']; ?>
							<p><strong><?php echo $alert_comment['pseudo_members']; ?></strong> le <?php echo $alert_comment['date_comment_fr']; ?></p>
							<p><?php echo nl2br($alert_comment['comment_comments']); ?></p>
							<a href="alert_cancel/<?php echo $alert_comment['id_comments']; ?>" class="btn btn__read btn__top">Annuler le signalement</a>
							<a href="delete_comment/<?php echo $alert_comment['id_comments']; ?>" class="btn btn__alert btn__bottom">Supprimer</a>
						</article>
					</li>
				<?php
				}
				?>
			</ul>
		<?php
        }else{
        ?>
            <p class="data__no">Pas de commentaire signalé</p>
        <?php
        }  
        ?>
	</section> 
	<section id="admin-comments-global" class="novel-section">
		<div id="admin-comments-global__flag"></div>
		<h3>Tous les commentaires</h3>
		<?php
		if($nbcomment_published > 0)
		{
		?>
			<ul>
				<?php
				foreach ($published_comments as $published_comment)
				{
				?>
					<li class="row justify-content-center no-gutters">
						<article class="col-md-8 col-sm-10 col-xs-12">
							<p>Episode n°<?php echo $published_comment['episod_number_episodes']; ?>
							<p><strong><?php echo $published_comment['pseudo_members']; ?></strong> le <?php echo $published_comment['date_comment_fr']; ?></p>
							<p><?php echo nl2br($published_comment['comment_comments']); ?></p>
							<a href="delete_comment/<?php echo $published_comment['id_comments']; ?>" class="btn btn__alert">Supprimer</a>
						</article>
					</li>
				<?php
				}
				?>
			</ul>
		<?php
        }else{
        ?>
            <p class="data__no">Pas de commentaire publié</p>
        <?php
        }  
        ?>
    </section>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>