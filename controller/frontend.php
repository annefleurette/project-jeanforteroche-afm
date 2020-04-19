<?php

require('./model/model.php');

function displayEpisodesNews()
{
	// On récupère le premier épisode de la série qui a été publié
	$req_first = getEpisodeFirst();
	// On récupère les 3 derniers épisodes publiés
	$episode_three = getEpisodesLastThree();        
	$nbepisode_three = count($episode_three);
	require('./view/frontend/indexView.php');
}

function displayEpisodesList()
{
	// On compte le nombre d'épisodes et on en répartit 3 par page
	$nbepisodes = countEpisodesPublished();
	$reading_pages = ceil(($nbepisodes['numberEpisodes'])/3);
	if (isset($_GET['page']) && ($_GET['page'] > 0))
	{
	    $page = htmlspecialchars($_GET['page']);
	}else{
	    $page = 1;
	}
	if ($page > $reading_pages) {
	    $page = $reading_pages;
	}
	// On récupère 3 épisodes publiés par page
	$episode_all = getEpisodesPublishedPagination($page);
	$nbepisode_all = count($episode_all);
	require('./view/frontend/episodesView.php');
}

function displayEpisodeUnitary()
{
	$_GET['number'] = htmlspecialchars($_GET['number']);
	// On récupère l'épisode unitaire souhaité
	$episode_unitary = getEpisode($_GET['number']);
	// On compe le nombre d'épisodes pour établir épisodes précédents/suivants
	$nbepisodes = countEpisodesPublished();
	$reading_pages = $nbepisodes['numberEpisodes'];
    $episode_current = intval($_GET['number']);
	$episode_before = $episode_current - 1;
    $episode_next = $episode_current + 1;
    // On affiche les commentaires de l'épisode
    $exe_idepisode = getEpisodeId($_GET['number']);
    $comments = getEpisodeComment($exe_idepisode);
    // On compte le nombre de commentaires
    $nbcomments = count($comments);
    require('./view/frontend/episodeView.php');
}

function addComment()
{
	if(isset($_SESSION['pseudo']))
    { // Si l'utilisateur est bien connecté
        if (isset($_POST['comment']))
        { // Si le commentaire existe bien
            $_GET['number'] = htmlspecialchars($_GET['number']);
            $_POST['comment'] = htmlspecialchars($_POST['comment']);
            // On récupère l'id d'un pseudo de membre
            $exe_idpseudo = getMemberId($_SESSION['pseudo']);
            // On récupère l'id d'une épisode donné
            $exe_idepisode = getEpisodeId($_GET['number']);
            // On enregistre le commentaire dans la base de données
            $newcomment = postComment($exe_idepisode, $exe_idpseudo, $_POST['comment']);
            header('Location: index.php?action=episode&amp;number=' . $_GET['number']);
        }else{
            header('Location: index.php?action=episode&amp;number=' . $_GET['number']);
        }   
   	}else{ // Sinon renvoi vers la pages Inscription/Connexion
        header('Location: index.php?action=subscription');
    }
}

function subscription()
{
	require('./view/frontend/subscriptionView.php');
}

function subscriptionPost()
{
	if (isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['password2']))
	{
		// On récupère tous les pseudos des membres inscrits
		$exe_pseudos = getMembersPseudo();
        // On récupère tous les emails des membres inscrits
        $exe_emails = getMembersEmail();
        $_POST['email'] = htmlspecialchars($_POST['email']);
        $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
        $_POST['password'] = htmlspecialchars($_POST['password']);
        $_POST['password2'] = htmlspecialchars($_POST['password2']);
        // Si le pseudo est bien nouveau
        if(!in_array(strtolower($_POST['pseudo']), $exe_pseudos) AND !in_array($_POST['email'], $exe_emails))
        {
        // Si l'adresse email possède bien le bon format
       		if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,}$#", $_POST['email']))
       		{
        	//Si le mot de passe correspond bien à sa vérification
        		if($_POST['password'] == $_POST['password2']) {
        		$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        		$newmember = addMember($_POST['pseudo'], $pass_hache, $_POST['email']);
				header('Location: index.php?action=login');
                //Envoi d'un email de confirmation
                    // Le message
                    $message = "Merci, votre inscription au blog de Jean Forteroche est bien confirmée !\r\nPour se connecter : www.jeanforteroche.com";
                    // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
                    $message = wordwrap($message, 70, "\r\n");
                    // Envoi du mail
                    mail($_POST['email'], 'Confirmation d\'inscription', $message);
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

function login()
{
	require('./view/frontend/loginView.php');
}

function loginPost()
{
	if (isset($_POST['email']) AND (isset($_POST['password'])))
	{
		$_POST['email'] = htmlspecialchars($_POST['email']);
		$_POST['password'] = htmlspecialchars($_POST['password']);
		// On récupère les informations de membre qui correspondent à l'email saisi
		$info_member = getMemberInfo($_POST['email']);
        $isPasswordCorrect = password_verify($_POST['password'], $info_member['password']);
        if(!$info_member)
        {
           	echo '<div class="error-message"><p>Mauvais identifiant ou mot de passe</p><p><a href="index.php?action=login">Retour</a></p></div>';    
        }else{
            if ($isPasswordCorrect)
            {
                session_start();
                $_SESSION['pseudo'] = $info_member['pseudo'];
                $_SESSION['type'] = $info_member['type'];
                setcookie($_POST['email'], time()+365*24*3600, null, null, false, true);
                setcookie(password_verify($_POST['password'], $resultat['password']), time()+365*24*3600, null, null, false, true);
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

function logout()
{
	session_start();
	$_SESSION = array();
	session_destroy();
	header('Location: index.php'); 
}

function unsubscribe()
{
	session_start();
	if(isset($_SESSION['pseudo']))
	{
		// On supprime un membre de la base de données
		$delete_member = deleteMember($_SESSION['pseudo']);
        $_SESSION = array();
		session_destroy();
		header('Location: index.php');
        //Envoi d'un email de confirmation
	        // Le message
	        $message = "Merci, nous vous confirmons votre désinscription au blog de Jean Forteroche\r\nDans l'espoir de vous revoir : www.jeanforteroche.com";
	        // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
	        $message = wordwrap($message, 70, "\r\n");
	        // Envoi du mail
	        mail($_POST['email'], 'Confirmation de désinscription', $message);
	}else{
		throw new Exception('Impossible de supprimer votre compte');
	}
}