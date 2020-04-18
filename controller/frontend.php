<?php
require('./model/frontend.php');

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
	// On récupère l'épisode unitaire souhaité
	$episode_unitary = getEpisode(htmlspecialchars($_GET['number']));
	// On compe le nombre d'épisodes pour établir épisodes précédents/suivants
	$nbepisodes = countEpisodesPublished();
	$reading_pages = $nbepisodes['numberEpisodes'];
    $episode_current = intval(htmlspecialchars($_GET['number']));
	$episode_before = $episode_current - 1;
    $episode_next = $episode_current + 1;
    // On affiche les commentaires de l'épisode
    $exe_idepisode = getEpisodeId(htmlspecialchars($_GET['number']));
    $comments = getEpisodeComment(htmlspecialchars($exe_idepisode));
    // On compte le nombre de commentaires
    $nbcomments = count($comments);
    require('./view/frontend/episodeView.php');
}

function subscription()
{
	require('./view/frontend/subscriptionView.php');
}

function login()
{
	// On récupère les informations de membre qui correspondent à l'email saisi
	$info_member = getMemberInfo(htmlspecialchars($_POST['email']));
	$isPasswordCorrect = password_verify($_POST['password'], $info_member['password']);
    require('./view/frontend/loginView.php');
}