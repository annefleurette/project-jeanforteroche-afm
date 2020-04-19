<?php
require('controller/frontend.php');
try {
	if(isset($_GET['action'])){
		switch($_GET['action']){
			case 'episode':
				if(isset($_GET['number'])){
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
		}
	}else{
		displayEpisodesNews();
	}
}catch(Exception $e){
    $errorMessage = $e->getMessage();
    require('view/404error.php');
}