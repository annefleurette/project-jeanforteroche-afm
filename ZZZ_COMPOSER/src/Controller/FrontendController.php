<?php
namespace AnneFleurMarchat\JeanForteroche\Controller;
// Chargement des classes
//require_once('model/MemberManager.php');
//require_once('model/EpisodeManager.php');
//require_once('model/CommentManager.php');

use AnneFleurMarchat\JeanForteroche\Model\MemberManager;
use AnneFleurMarchat\JeanForteroche\Model\EpisodeManager;
use AnneFleurMarchat\JeanForteroche\Model\CommentManager;

class FrontendController {

	public function displayEpisodesNews()
	{
		$episodeManager = new EpisodeManager();
		// On récupère le premier épisode de la série qui a été publié
		$episode_first = $episodeManager->getEpisodeFirst();
		// On récupère les 3 derniers épisodes publiés
		$episode_three = $episodeManager->getEpisodesLastThree();        
		$nbepisode_three = count($episode_three);
		require('./src/View/frontend/indexView.php');
	}

	public function displayEpisodesList()
	{
		$episodeManager = new EpisodeManager();
		// On compte le nombre d'épisodes et on en répartit 3 par page
		$nbepisodes = $episodeManager->countEpisodesPublished();
		if($nbepisodes != 0)
		{
			$reading_pages = ceil(($nbepisodes)/3);
			if (isset($_GET['page']) && ($_GET['page'] > 0))
			{
				$page = htmlspecialchars($_GET['page']);
			}else{
				$page = 1;
			}
			if ($page > $reading_pages)
			{
				$page = $reading_pages;
			}
			// On récupère 3 épisodes publiés par page
			$episode_all = $episodeManager->getEpisodesPublishedPagination($page);
			$nbepisode_all = count($episode_all);
		
		}
		require('./src/View/frontend/episodesView.php');
	}

	public function displayEpisodeUnitary()
	{
		$episodeManager = new EpisodeManager();
		$commentManager = new CommentManager();
		$getnumber = htmlspecialchars($_GET['number']);
		// On récupère l'épisode unitaire souhaité
		$episode_unitary_published = $episodeManager->getEpisodePublished($getnumber);
		// On compe le nombre d'épisodes pour établir épisodes précédents/suivants
		$nbepisodes = $episodeManager->countEpisodesPublished();
		$reading_pages = $nbepisodes;
		$episode_current = intval($getnumber);
		$episode_before = $episode_current - 1;
		$episode_next = $episode_current + 1;
		// On affiche les commentaires de l'épisode
		$exe_idepisode = $episodeManager->getEpisodeId($getnumber);
		$comments = $commentManager->getEpisodeComment($exe_idepisode);
		// On compte le nombre de commentaires
		$nbcomments = count($comments);
		require('./View/frontend/episodeView.php');
	}

	public function addComment()
	{
		$commentManager = new CommentManager();
		$memberManager = new MemberManager();
		$episodeManager = new EpisodeManager();
		if(isset($_SESSION['pseudo']))
		{ // Si l'utilisateur est bien connecté
			if (isset($_POST['comment']))
			{ // Si le commentaire existe bien
				$getnumber = htmlspecialchars($_GET['number']);
				$postcomment = htmlspecialchars($_POST['comment']);
				// On récupère l'id d'un pseudo de membre
				$exe_idpseudo = $memberManager->getMemberId($_SESSION['pseudo']);
				// On récupère l'id d'une épisode donné
				$exe_idepisode = $episodeManager->getEpisodeId($getnumber);
				// On enregistre le commentaire dans la base de données
				$newcomment = $commentManager->postComment($exe_idepisode, $exe_idpseudo, $postcomment);
				header('Location: index.php?action=episode&number=' . $getnumber);
			}else{
				header('Location: index.php?action=episode&number=' . $getnumber);
			}   
		}else{ // Sinon renvoi vers la pages Inscription/Connexion
			header('Location: index.php?action=subscription');
		}
	}

	public function subscription()
	{
		require('./View/frontend/subscriptionView.php');
	}

	public function subscriptionPost()
	{
		$memberManager = new MemberManager();
		if (isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['password2']))
		{
			// On récupère tous les pseudos des membres inscrits
			$exe_pseudos = $memberManager->getMembersPseudo();
			// On récupère tous les emails des membres inscrits
			$exe_emails = $memberManager->getMembersEmail();
			$postemail = htmlspecialchars($_POST['email']);
			$postpseudo = htmlspecialchars($_POST['pseudo']);
			$postpassword = htmlspecialchars($_POST['password']);
			$postpassword2 = htmlspecialchars($_POST['password2']);
			// Si le pseudo est bien nouveau
			if(!in_array(strtolower($postpseudo), $exe_pseudos) AND !in_array($postemail, $exe_emails))
			{
			// Si l'adresse email possède bien le bon format
				if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,}$#", $postemail))
				{
				//Si le mot de passe correspond bien à sa vérification
					if($postpassword == $postpassword2) {
					$pass_hache = password_hash($postpassword, PASSWORD_DEFAULT);
					$newmember = $memberManager->addMember($postpseudo, $pass_hache, $postemail);
					header('Location: index.php?action=login');
					//Envoi d'un email de confirmation
						$to      = $postemail;
						$subject = 'Confirmation d\'inscription';
						$message = 'Merci, votre inscription au blog de Jean Forteroche est bien confirmée ! Pour se connecter : www.jeanforteroche.com';
						$headers = array(
							'From' => 'noreply@jeanforteroche.com',
						);
						mail($to, $subject, $message, $headers);
					}else{
						echo '<div class="error-message"><p>Les mots de passe ne correspondent pas</p><p><a href="index.php?action=subscription">Retour</a></p></div>';
					}
				}else{
					echo '<div class="error-message"><p>Il y a une erreur dans l\'adresse email</p><p><a href="index.php?action=subscription">Retour</a></p></div>';
				}
			}else{
				echo '<div class="error-message"><p>Ce pseudo ou cet email est déjà utilisé</p><p><a href="index.php?action=subscription">Retour</a></p></div>';
			}
		}else{
			echo '<div class="error-message"><p>Vous n\'avez pas complété tous les champs</p><p><a href="index.php?action=subscription">Retour</a></p></div>';
		}
	}

	public function login()
	{
		require('./View/frontend/loginView.php');
	}

	public function loginPost()
	{
		$memberManager = new MemberManager();
		if (isset($_POST['email']) AND (isset($_POST['password'])))
		{
			$postemail = htmlspecialchars($_POST['email']);
			$postpassword = htmlspecialchars($_POST['password']);
			// On récupère les informations de membre qui correspondent à l'email saisi
			$info_member = $memberManager->getMemberInfo($postemail);
			$isPasswordCorrect = password_verify($postpassword, $info_member['password']);
			if(!$info_member)
			{
				echo '<div class="error-message"><p>Mauvais identifiant ou mot de passe</p><p><a href="index.php?action=login">Retour</a></p></div>';    
			}else{
				if ($isPasswordCorrect)
				{
					session_start();
					$_SESSION['pseudo'] = $info_member['pseudo'];
					$_SESSION['type'] = $info_member['type'];
					if($_POST['remember'] == "on") { // On enregistre l'email que si l'utilisateur le souhaite
					setcookie($_POST['email'], time()+365*24*3600, null, null, false, true);
					}
					if($info_member['type'] == "admin")
					{ // Si le membre est admin
						header('Location: index.php?action=admin'); 
					}else{ // Si le membre est reader
						header('Location: index.php?action=episode');
					}
				}else{
					echo '<div class="error-message"><p>Mauvais identifiant ou mot de passe</p><p><a href="index.php?action=login">Retour</a></p></div>';  
				}
			}
		}else{
			echo '<div class="error-message"><p>Vous n\'avez pas saisi votre identifiant ou votre mot de passe</p><p><a href="index.php?action=login">Retour</a></p></div>'; 
		}
	}

	public function logout()
	{
		session_start();
		$_SESSION = array();
		session_destroy();
		header('Location: index.php'); 
	}

	public function unsubscribe()
	{
		$memberManager = new MemberManager();
		session_start();
		if(isset($_SESSION['pseudo']))
		{
			// On supprime un membre de la base de données
			$delete_member = $memberManager->deleteMemberDb($_SESSION['pseudo']);
			$_SESSION = array();
			session_destroy();
			header('Location: index.php');
			$exe_email = $memberManager->getMemberEmail($_SESSION['pseudo']);
			//Envoi d'un email de confirmation
				$to      = $exe_email['email'];
				$subject = 'Confirmation de désinscription';
				$message = 'Nous vous confirmons votre désinscription au blog de Jean Forteroche. Dans l\'espoir de vous revoir : www.jeanforteroche.com';
				$headers = array(
					'From' => 'noreply@jeanforteroche.com',
				);
				mail($to, $subject, $message, $headers);
		}else{
			throw new \Exception('Impossible de supprimer votre compte');
		}
	}

}