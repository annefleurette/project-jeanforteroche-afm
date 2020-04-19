<?php
session_start();
require('controller/frontend.php');
require('controller/backend.php');
try {
	if(isset($_GET['action']))
	{
		switch($_GET['action'])
		{
			case 'episode':
				if(isset($_GET['number']))
				{
					displayEpisodeUnitary();
				}else{
					displayEpisodesList();
				}
				break;
			case 'comment_post':
				addComment();
				break;
			case 'subscription':
				subscription();
				break;
			case 'subscription_post':
				subscriptionPost();
				break;
			case 'login':
				login();
				break;
			case 'login_post':
				loginPost();
				break;
			case 'logout':
				logout();
				break;
			case 'unsubscribe':
				unsubscribe();
				break;
			case 'admin':
				if(isset($_SESSION['pseudo']) AND ($_SESSION['type'] == "admin"))
				{
					displayAdmin();
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'write':
				writeEpisode();
				break;
			case 'write_post':
				writeEpisodePost();
				break;
			case 'delete_episode':
				if(isset($_GET['id']))
				{
					deleteEpisodePost();
				}else{
					throw new Exception('Erreur');
				}
				break;
		}
	}else{
		displayEpisodesNews();
	}
}catch(Exception $e){
    $errorMessage = $e->getMessage();
    require('view/404error.php');
}