<?php
//On récupère le premier épisode publié
function getEpisodeFirst()
{
	$db = dbConnect();
	$req_first = $db->query('SELECT episode_number FROM episodes WHERE episode_number = 1 AND episode_status = "published"');
    $episode_first = $req_first->fetch();
    $req_first->closeCursor();
	return $episode_first;
}

//On récupère les 3 derniers épisodes publiés
function getEpisodesLastThree()
{
	$db = dbConnect();
	$req_three = $db->query('SELECT episode_number, episode_title, episode_content FROM episodes WHERE episode_status = "published" ORDER BY episode_number DESC LIMIT 0, 3');
	$episode_three = $req_three->fetchAll();
	$req_three->closeCursor();
	return $episode_three;
}

//On compte le nombre d'épisodes qui ont été publiés
function countEpisodesPublished()
{
	$db = dbConnect();
	$count_episodes = $db->query('SELECT COUNT(*) AS numberEpisodes FROM episodes WHERE episode_status = "published"');
	$nbepisodes = $count_episodes->fetch();
	$count_episodes->closeCursor();
	return $nbepisodes;
}

//On récupère 3 épisodes publiés par page
function getEpisodesPublishedPagination($page)
{
	$db = dbConnect();
	$req_episodes = $db->query('SELECT episode_number, episode_title, episode_content FROM episodes WHERE episode_status = "published" ORDER BY episode_number LIMIT '. ($page-1)*3 .',3');
	$episode_all = $req_episodes->fetchAll();
	$req_episodes->closeCursor();
	return $episode_all;
}

//On récupère l'épisode unitaire souhaité
function getEpisode($number)
{
    $db = dbConnect();
    $req_episode = $db->prepare('SELECT episode_title, episode_content FROM episodes WHERE episode_number = ?');
    $req_episode->execute(array($number));
    $episode_unitary = $req_episode->fetch();
    $req_episode->closeCursor();
    return $episode_unitary;
}

// On récupère l'id d'un épisode donné
function getEpisodeId($number)
{
	$db = dbConnect();
    $req_idepisode = $db->prepare('SELECT id FROM episodes WHERE episode_number = ?');
    $req_idepisode->execute(array($number));
    $exe_idepisode = $req_idepisode->fetch(PDO::FETCH_COLUMN);
    $req_idepisode->closeCursor();
    return $exe_idepisode;
}

// On récupère les commentaires d'un épisode
function getEpisodeComment($id)
{
	$db = dbConnect();
	$comment_recup = $db->prepare('SELECT m.pseudo pseudo_members, c.comment comment_comments, c.id id_comments, DATE_FORMAT(c.date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM members m INNER JOIN comments c ON m.id = c.id_pseudo WHERE c.id_episode = ? ORDER BY date_comment');
    $comment_recup->execute(array($id));
    $comments = $comment_recup->fetchAll();
    $comment_recup->closeCursor();
    return $comments;
}

// On récupère les informations de membre qui correspondent à l'email saisi
function getMemberInfo($email)
{
	$db = dbConnect();
	$req_member = $db->prepare('SELECT pseudo, password, type FROM members WHERE email = ?');
    $req_member->execute(array($email));
    $info_member = $req_member->fetch();
    $req_member->closeCursor();
    return $info_member;
}

//On récupère la base de donnnées
function dbConnect()
{
	$db = new PDO('mysql:host=localhost;dbname=novel;charset=utf8', 'root', 'root');
	return $db;
}
?>