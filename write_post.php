<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Création d'épisode</title>
        <meta name="description" content="L'écriture en cours d'un nouvel épisode par Jean Forteroche">
    </head>
<body>  
	<div class="container">
		<?php
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=novel;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e)
		{
		        die('Erreur : '.$e->getMessage());
		}
		// On compte le nombre d'épisodes publiés
        $count = $bdd->query('SELECT COUNT(*) AS numberEpisodesPublished FROM episodes WHERE episode_status = "published"');
        $episode_published = $count->fetch();
        $count_episode_published = intval($episode_published['numberEpisodesPublished']);
        $count_episode_publishable = $count_episode_published + 1;
		if(isset($_POST['save'])) { // Si le bouton Enregistrer est choisi
			// Enregistrement de l'épisode dans la base de données
			// Si les données ont bien été saisies
			if (isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
			{
				//Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
				$look = $bdd->prepare('SELECT * FROM episodes WHERE episode_number = ? AND episode_status="published"');
				$look->execute(array($_POST['number']));
				$episode_result = $look->fetch();
				$_POST['number'] = htmlspecialchars($_POST['number']);
				$_POST['title'] = htmlspecialchars($_POST['title']);
				if (empty($episode_result)){
					$req = $bdd->prepare('INSERT INTO episodes (episode_number, episode_title, episode_content, episode_status) VALUES(?, ?, ?, \'inprogress\')');
					$req->execute(array($_POST['number'], $_POST['title'], $_POST['content']));	
					header('Location: admin.php');
				} else {
						?>
						<p>Vous avez déjà publié ce numéro d'épisode !</p>
						<a href="write.php">Recommencer</a>
						<?php
				}
				$look->closeCursor();
			}
		} else { // Si le bouton Publier est choisi
			// Enregistrement de l'épisode à publier dans la base de données
			// Si les données ont bien été saisies
			if (isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
			{
			// Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés et si ce numéro est bien le +1 du dernier épisode publié
				$look = $bdd->prepare('SELECT * FROM episodes WHERE episode_number = ? AND episode_status="published"');
				$look->execute(array($_POST['number']));
				$current_episode = intval($_POST['number']);
				$episode_result = $look->fetch();
				$_POST['number'] = htmlspecialchars($_POST['number']);
				$_POST['title'] = htmlspecialchars($_POST['title']);
					if (empty($episode_result) AND ($current_episode == $count_episode_publishable)){
						$req = $bdd->prepare('INSERT INTO episodes (episode_number, episode_title, episode_content, episode_status) VALUES(?, ?, ?, \'published\')');
						$req->execute(array($_POST['number'], $_POST['title'], $_POST['content']));
						header('Location: admin.php');
					} else {
						?>
						<p>Vous avez déjà publié ce numéro d'épisode ou cet épisode n'est pas le suivant du dernier épisode publié !</p>
						<a href="write.php">Recommencer</a>
						<?php
					}
				$look->closeCursor();
			}
		}
		$count->closeCursor();
		?>
	</div>
</body>
