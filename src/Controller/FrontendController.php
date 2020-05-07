<?php
namespace AnneFleurMarchat\JeanForteroche\Controller;

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

	public function displayEpisodesList($getpage)
	{
		$episodeManager = new EpisodeManager();
		// On compte le nombre d'épisodes et on en répartit 3 par page
		$nbepisodes = $episodeManager->countEpisodesPublished();
		if($nbepisodes != 0)
		{
			$reading_pages = ceil(($nbepisodes)/3);
			if (isset($getpage) && ($getpage > 0))
			{
				$page = htmlspecialchars($getpage);
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

	public function displayEpisodeUnitary($getnumber)
	{
		$episodeManager = new EpisodeManager();
		$commentManager = new CommentManager();
		$getnumber = htmlspecialchars($getnumber);
		// On récupère l'épisode unitaire souhaité
		$episode_unitary_published = $episodeManager->getEpisodePublished($getnumber);
		// On compte le nombre d'épisodes pour établir épisodes précédents/suivants
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
		require('./src/View/frontend/episodeView.php');
	}

	public function addComment($sessionpseudo, $getnumber, $postcomment)
	{
		$commentManager = new CommentManager();
		$memberManager = new MemberManager();
		$episodeManager = new EpisodeManager();
		if(isset($sessionpseudo))
		{ // Si l'utilisateur est bien connecté
			if (isset($postcomment))
			{ // Si le commentaire existe bien
				$postcomment = htmlspecialchars($postcomment);
				$getnumber = htmlspecialchars($getnumber);
				// On récupère l'id d'un pseudo de membre
				$exe_idpseudo = $memberManager->getMemberId($sessionpseudo);
				// On récupère l'id d'une épisode donné
				$exe_idepisode = $episodeManager->getEpisodeId($getnumber);
				// On enregistre le commentaire dans la base de données
				$newcomment = $commentManager->postComment($exe_idepisode, $exe_idpseudo, $postcomment);
				echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Votre commentaire est bien enregistré !</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/episode/number-' .$getnumber. '">Retour</a></p></div>'; 
			}else{
				echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous n\'avez pas saisi votre commentaire</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/episode/number-' .$getnumber. '">Retour</a></p></div>'; 
			}   
		}else{ // Sinon renvoi vers la pages Inscription/Connexion
			header('Location: http://www.jeanforteroche.com/subscription');
		}
	}

	public function subscription()
	{
		require('./src/View/frontend/subscriptionView.php');
	}

	public function subscriptionPost($postpseudo, $postemail, $postpassword, $postpassword2)
	{
		$memberManager = new MemberManager();
		if (isset($postpseudo) AND isset($postemail) AND isset($postpassword) AND isset($postpassword2))
		{
			// On récupère tous les pseudos des membres inscrits
			$exe_pseudos = $memberManager->getMembersPseudo();
			// On récupère tous les emails des membres inscrits
			$exe_emails = $memberManager->getMembersEmail();
			$postemail = htmlspecialchars($postemail);
			$postpseudo = htmlspecialchars($postpseudo);
			$postpassword = htmlspecialchars($postpassword);
			$postpassword2 = htmlspecialchars($postpassword2);
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
					header('Location: http://www.jeanforteroche.com/login');
					//Envoi d'un email de confirmation
						$to      = $postemail;
						$subject = 'Confirmation d\'inscription';
						$message = 'Merci, nous vous confirmons votre inscription au blog de Jean Forteroche ! Pour se connecter : www.jeanforteroche.com';
						$headers = array(
							'From' => 'no-reply@jeanforteroche.com',
						);
						mail($to, $subject, $message, $headers);
					}else{
						echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Les mots de passe ne correspondent pas</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/subscription">Retour</a></p></div>'; 
					}
				}else{
					echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Il y a une erreur dans l\'adresse email</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/subscription">Retour</a></p></div>';
				}
			}else{
				echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Ce pseudo ou cet email est déjà utilisé</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/subscription">Retour</a></p></div>';
			}
		}else{
			echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous n\'avez pas complété tous les champs</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/subscription">Retour</a></p></div>';
		}
	}

	public function login()
	{
		require('./src/View/frontend/loginView.php');
	}

	public function loginPost($postemail, $postpassword, $postremember)
	{
		$memberManager = new MemberManager();
		if (isset($postemail) AND (isset($postpassword)))
		{
			$postemail = htmlspecialchars($postemail);
			$postpassword = htmlspecialchars($postpassword);
			// On récupère les informations de membre qui correspondent à l'email saisi
			$info_member = $memberManager->getMemberInfo($postemail);
			if(!$info_member)
			{
				echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Mauvais identifiant ou mot de passe</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/login">Retour</a></p></div>';    
			}else{
				$isPasswordCorrect = password_verify($postpassword, $info_member['password']);
				if ($isPasswordCorrect)
				{
					session_start();
					$_SESSION['pseudo'] = $info_member['pseudo'];
					$_SESSION['type'] = $info_member['type'];
					if($postremember == "on") { // On enregistre l'email que si l'utilisateur le souhaite
					setcookie($postemail, time()+365*24*3600, null, null, false, true);
					}
					if($info_member['type'] == "admin")
					{ // Si le membre est admin
						header('Location: http://www.jeanforteroche.com/admin'); 
					}else{ // Si le membre est reader
						header('Location: http://www.jeanforteroche.com/episode');
					}
				}else{
					echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Mauvais identifiant ou mot de passe</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/login">Retour</a></p></div>';  
				}
			}
		}else{
			echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous n\'avez pas saisi votre identifiant ou votre mot de passe</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/login">Retour</a></p></div>'; 
		}
	}

	public function logout()
	{
		session_start();
		$_SESSION = array();
		session_destroy();
		header('Location: http://www.jeanforteroche.com/index'); 
	}

	public function unsubscribe($sessionpseudo)
	{
		$memberManager = new MemberManager();
		session_start();
		if(isset($sessionpseudo))
		{
			// On supprime un membre de la base de données
			$delete_member = $memberManager->deleteMemberDb($sessionpseudo);
			$_SESSION = array();
			session_destroy();
			header('Location: http://www.jeanforteroche.com/index');
			$exe_email = $memberManager->getMemberEmail($sessionpseudo);
			//Envoi d'un email de confirmation
				$to      = $exe_email['email'];
				$subject = 'Confirmation de désinscription';
				$message = 'Nous vous confirmons la suppression de votre compte sur le blog de Jean Forteroche. Dans l\'espoir de vous revoir : www.jeanforteroche.com';
				$headers = array(
					'From' => 'no-reply@jeanforteroche.com',
				);
				mail($to, $subject, $message, $headers);
		}else{
			throw new \Exception('Impossible de supprimer votre compte');
		}
	}

}