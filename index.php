<?php
session_start();

use AnneFleurMarchat\JeanForteroche\Controller\FrontendController;
use AnneFleurMarchat\JeanForteroche\Controller\BackendController;

require('vendor/autoload.php');

try {
	$frontendController = new FrontendController();
	$backendController = new BackendController();
	if(isset($_GET['action']))
	{
		switch($_GET['action'])
		{
			case 'episode':
				if(isset($_GET['number']))
				{
					$frontendController->displayEpisodeUnitary();
				}else{
					$frontendController->displayEpisodesList();
				}
				break;
			case 'comment_post':
				$frontendController->addComment();
				break;
			case 'subscription':
				$frontendController->subscription();
				break;
			case 'subscription_post':
				$frontendController->subscriptionPost();
				break;
			case 'login':
				$frontendController->login();
				break;
			case 'login_post':
				$frontendController->loginPost();
				break;
			case 'logout':
				$frontendController->logout();
				break;
			case 'unsubscribe':
				$frontendController->unsubscribe();
				break;
			case 'admin':
				if(isset($_SESSION['pseudo']) AND ($_SESSION['type'] == "admin"))
				{
					$backendController->displayAdmin();
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'write':
				$backendController->writeEpisode();
				break;
			case 'write_post':
				$backendController->writeEpisodePost();
				break;
			case 'delete_episode':
				if(isset($_GET['id']))
				{
					$backendController->deleteEpisode();
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'update_episode':
				if(isset($_GET['id']))
				{
					$backendController->updateEpisode();
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'update_post':
				$backendController->updateEpisodePost();
				break;
			case 'look_episode':
				if(isset($_GET['id']))
				{
					$backendController->lookEpisode();
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'alert_post':
				if(isset($_GET['id']))
				{
					$backendController->alertCommentPost();
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'alert_cancel':
				if(isset($_GET['id']))
				{
					$backendController->alertCommentCancel();
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'delete_comment':
				if(isset($_GET['id']))
				{
					$backendController->deleteComment();
				}else{
					throw new Exception('Erreur');
				}
				break;	
		}
	}else{
		$frontendController->displayEpisodesNews();
	}
}catch(Exception $e){
	$errorMessage = $e->getMessage();
	require('View/404error.php');
}