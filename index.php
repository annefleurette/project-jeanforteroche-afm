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
					$frontendController->displayEpisodeUnitary($_GET['number']);
				}else{
					$frontendController->displayEpisodesList($_GET['page']);
				}
				break;
			case 'comment_post':
				$frontendController->addComment($_SESSION['pseudo'],$_GET['number'], $_POST['comment']);
				break;
			case 'subscription':
				$frontendController->subscription();
				break;
			case 'subscription_post':
				$frontendController->subscriptionPost($_POST['pseudo'], $_POST['email'], $_POST['password'], $_POST['password2']);
				break;
			case 'login':
				$frontendController->login();
				break;
			case 'login_post':
				$frontendController->loginPost($_POST['email'], $_POST['password'], $_POST['remember']);
				break;
			case 'logout':
				$frontendController->logout();
				break;
			case 'unsubscribe':
				$frontendController->unsubscribe($_SESSION['pseudo']);
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
				$backendController->writeEpisodePost($_POST['save'], $_POST['number'], $_POST['title'], $_POST['content']);
				break;
			case 'delete_episode':
				if(isset($_GET['id']))
				{
					$backendController->deleteEpisode($_GET['id']);
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'update_episode':
				if(isset($_GET['id']))
				{
					$backendController->updateEpisode($_GET['id']);
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'update_post':
				$backendController->updateEpisodePost($_POST['save'], $_POST['number'], $_POST['title'], $_POST['content'], $_GET['id']);
				break;
			case 'look_episode':
				if(isset($_GET['id']))
				{
					$backendController->lookEpisode($_GET['id']);
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'alert_post':
				if(isset($_GET['id']))
				{
					$backendController->alertCommentPost($_GET['id']);
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'alert_cancel':
				if(isset($_GET['id']))
				{
					$backendController->alertCommentCancel($_GET['id']);
				}else{
					throw new Exception('Erreur');
				}
				break;
			case 'delete_comment':
				if(isset($_GET['id']))
				{
					$backendController->deleteComment($_GET['id']);
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
	require('src/View/404error.php');
}