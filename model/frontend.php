<?php

// Requêtes table MEMBERS

// On récupère l'id d'un pseudo de membre
function getMemberId($pseudo)
{
	$db = dbConnect();
	$req_idpseudo = $db->prepare('SELECT id FROM members WHERE pseudo = ?');
    $req_idpseudo->execute(array($pseudo));
    $exe_idpseudo = $req_idpseudo->fetch(PDO::FETCH_COLUMN);
    $req_idpseudo->closeCursor();
    return $exe_idpseudo;
}

// On récupère tous les pseudos des membres inscrits
function getMembersPseudo()
{
	$db = dbConnect();
	$req_pseudos = $db->query('SELECT pseudo FROM members');
    $exe_pseudos = $req_pseudos->fetchAll(PDO::FETCH_COLUMN);
    $req_pseudos->closeCursor();
    return $exe_pseudos;
}

// On récupère tous les emails des membres inscrits
function getMembersEmail()
{
	$db = dbConnect();
	$req_emails = $db->query('SELECT email FROM members');
    $exe_emails = $req_emails->fetchAll(PDO::FETCH_COLUMN);
    $req_emails->closeCursor();
    return $exe_emails;
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

// On enregistre un nouveau membre dans la base de données
function addMember($pseudo, $password, $email)
{
	$db = dbConnect();
	$newmember = $db->prepare('INSERT INTO members (pseudo, password, email, date_subscription, type) VALUES(?, ?, ?, CURDATE(), \'reader\')');
    $newmember->execute(array($pseudo, $password, $email));
    return $newmember;
}

// On supprime un membre de la base de données
function deleteMember($pseudo)
{
	$db = dbConnect();
	$delete_member = $db->prepare('DELETE FROM members WHERE pseudo = ?');
    $delete_member->execute(array($pseudo));
    return $delete_member;
}

// Requêtes table EPISODES

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

// Requêtes table COMMENTS

// On enregistre le commentaire dans la base de données
function postComment($idepisode, $idpseudo, $comment) {
	$db = dbConnect();
	$newcomment = $db->prepare('INSERT INTO comments (id_episode, id_pseudo, comment, date_comment) VALUES(?, ?, ?, NOW())');
    $newcomment->execute(array($idepisode, $idpseudo, $comment));
    return $newcomment;
}

// Requêtes tables jointes

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

//Récupération de la la base de donnnées

function dbConnect()
{
	$db = new PDO('mysql:host=localhost;dbname=novel;charset=utf8', 'root', 'root');
	return $db;
}

?>