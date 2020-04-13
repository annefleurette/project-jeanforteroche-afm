<?php
//Récupération du premier épisode publié
function getEpisodeFirst()
{
$db = dbConnect();
$req = $db->query('SELECT episode_number FROM episodes WHERE episode_number = 1');
$episode_first = $req->fetch();
return $episode_first;
}

//Récupération des 3 derniers épisodes publiés
function getEpisodesLastThree()
{
$db = dbConnect();
$req = $db->query('SELECT episode_number, episode_title, episode_content FROM episodes WHERE episode_status = "published" ORDER BY episode_number DESC LIMIT 0, 3');
$episode_three = $req->fetchAll();
return $episode_three;
}

//Récupération de l'ensemble des id des épisodes publiés
function getEpisodesPublishedId()
{
$db = dbConnect();
$req = $db->query('SELECT id FROM episodes WHERE episode_status = "published"');
$episodes_published_id = $req->fetchAll(PDO::FETCH_COLUMN);
return $episodes_published_id;
}

//Décompte du nombre d'épisodes publiés
function getEpisodesPublishedNumber()
{
$db = dbConnect();
$pagination = $db->query('SELECT COUNT(*) AS numberEpisodes FROM episodes WHERE episode_status = "published"');
$reading = $pagination->fetch();
$reading_pages = ceil(($reading['numberEpisodes'])/3);
return $reading_pages;
}

//Affichage des épisodes et pagination
function getEpisodesPublishedAll()
{
$db = dbConnect();
$req = $db->query('SELECT episode_number, episode_title, episode_content FROM episodes WHERE episode_status = "published" ORDER BY episode_number LIMIT '. ($page-1)*3 .',3');
$episode_all = $req->fetchAll();
$nbepisode_all = count($episode_all);
return $nbepisode_all;
}

//Récupération de la base de donnnées
function dbConnect()
{
    $db = new PDO('mysql:host=localhost;dbname=novel;charset=utf8', 'root', 'root');
	return $db;
}
?>