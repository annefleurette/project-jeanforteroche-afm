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
			case 'subscription':
				subscription();
				break;
			case 'login':
				login();
				break;
		}
	}else{
		displayEpisodesNews();
	}
}catch(Exception $e){
    $errorMessage = $e->getMessage();
    require('view/404error.php');
}