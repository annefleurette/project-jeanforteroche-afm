<?php
namespace AnneFleurMarchat\JeanForteroche\Model;
//require_once("model/Manager.php");
use AnneFleurMarchat\JeanForteroche\Model\Manager;
class EpisodeManager extends Manager
{
	// On récupère tous les épisodes publiés
	public function getEpisodesPublished()
	{
		$db = $this->dbConnect();
		$req_published = $db->query('SELECT id, episode_number, episode_title FROM episodes WHERE episode_status = "published" ORDER BY episode_number');
		$published = $req_published->fetchAll();
		$req_published->closeCursor();
		return $published;
	}
	
	// On récupère tous les épisodes enregistrés
	public function getEpisodesInprogress()
	{
		$db = $this->dbConnect();
		$req_inprogress = $db->query('SELECT id, episode_number, episode_title FROM episodes WHERE episode_status = "inprogress" ORDER BY episode_number');
		$inprogress = $req_inprogress->fetchAll();
		$req_inprogress->closeCursor();
		return $inprogress;
	}
	//On récupère 3 épisodes publiés par page
	public function getEpisodesPublishedPagination($page)
	{
		$db = $this->dbConnect();
		$req_episodes = $db->query('SELECT episode_number, episode_title, episode_content FROM episodes WHERE episode_status = "published" ORDER BY episode_number LIMIT '. ($page-1)*3 .',3');
		$episode_all = $req_episodes->fetchAll();
		$req_episodes->closeCursor();
		return $episode_all;
	}

	// On récupère un épisode unitaire publié ou enregistré sur la base de données via son id
	public function getEpisode($id)
	{
		$db = $this->dbConnect();
		$req_episode = $db->prepare('SELECT * FROM episodes WHERE id = ?');
		$req_episode->execute(array($id));
		$episode_unitary = $req_episode->fetch();
		$req_episode->closeCursor();
		return $episode_unitary;
	}

	// On récupère un épisode unitaire publié via son numéro d'épisode
	public function getEpisodePublished($number)
	{
		$db = $this->dbConnect();
		$req_episode = $db->prepare('SELECT * FROM episodes WHERE episode_number = ? AND episode_status="published"');
		$req_episode->execute(array($number));
		$episode_unitary_published = $req_episode->fetch();
		$req_episode->closeCursor();
		return $episode_unitary_published;
	}

	// On récupère un épisode unitaire via son id
	public function getEpisodeInprogress($id)
	{
		$db = $this->dbConnect();
		$req_episode = $db->prepare('SELECT episode_number, episode_title, episode_content FROM episodes WHERE id = ?');
		$req_episode ->execute(array($id));
		$lookepisode = $req_episode->fetch();
		$req_episode->closeCursor();
		return $lookepisode;
	}

	//On récupère le premier épisode publié
	public function getEpisodeFirst()
	{
		$db = $this->dbConnect();
		$req_first = $db->query('SELECT episode_number FROM episodes WHERE episode_number = 1 AND episode_status = "published"');
		$episode_first = $req_first->fetch();
		$req_first->closeCursor();
		return $episode_first;
	}

	//On récupère les 3 derniers épisodes publiés
	public function getEpisodesLastThree()
	{
		$db = $this->dbConnect();
		$req_three = $db->query('SELECT episode_number, episode_title, episode_content FROM episodes WHERE episode_status = "published" ORDER BY episode_number DESC LIMIT 0, 3');
		$episode_three = $req_three->fetchAll();
		$req_three->closeCursor();
		return $episode_three;
	}

	// On récupère l'id d'un épisode donné
	public function getEpisodeId($number)
	{
		$db = $this->dbConnect();
		$req_idepisode = $db->prepare('SELECT id FROM episodes WHERE episode_number = ?');
		$req_idepisode->execute(array($number));
		$exe_idepisode = $req_idepisode->fetch(\PDO::FETCH_COLUMN);
		$req_idepisode->closeCursor();
		return $exe_idepisode;
	}

	//On compte le nombre d'épisodes qui ont été publiés
	public function countEpisodesPublished()
	{
		$db = $this->dbConnect();
		$count_episodes = $db->query('SELECT COUNT(*) FROM episodes WHERE episode_status = "published"');
		$nbepisodes = $count_episodes->fetch(\PDO::FETCH_COLUMN);
		$count_episodes->closeCursor();
		return $nbepisodes;
	}

	// On enregistre un nouvel épisode
	public function addEpisodeInprogress($number, $title, $content)
	{
		$db = $this->dbConnect();
		$req_add_episode = $db->prepare('INSERT INTO episodes (episode_number, episode_title, episode_content, episode_status) VALUES(?, ?, ?, \'inprogress\')');
		$req_add_episode->execute(array($number, $title, $content));
		return $req_add_episode;
	}

	// On publie un nouvel épisode
	public function addEpisodePublished($number, $title, $content)
	{
		$db = $this->dbConnect();
		$req_add_episode_published = $db->prepare('INSERT INTO episodes (episode_number, episode_title, episode_content, episode_status) VALUES(?, ?, ?, \'published\')');
		$req_add_episode_published->execute(array($number, $title, $content));
		return $req_add_episode_published;
	}

	// On modifie un épisode
	public function updateEpisodeInprogress($number, $title, $content, $status, $id)
	{
		$db = $this->dbConnect();
		$update_episode_inprogress = $db->prepare('UPDATE episodes SET episode_number = :newnumber, episode_title = :newtitle, episode_content = :newcontent, episode_status = :newstatus WHERE id = :id');
        $update_episode_inprogress->execute(array(
            'newnumber' => $number,
            'newtitle' => $title,
            'newcontent' => $content,
            'newstatus' => $status,
            'id' => $id
		)); 
		return $update_episode_inprogress;
	}

	// On modifie un épisode publié
	public function updateEpisodePublished($title, $content, $id)
	{
		$db = $this->dbConnect();
		$update_episode_published = $db->prepare('UPDATE episodes SET episode_title = :newtitle, episode_content = :newcontent WHERE id = :id');
		$update_episode_published->execute(array(
			'newtitle' => $title,
			'newcontent' => $content,
			'id' => $id
		)); 
		return $update_episode_published;
	}

	// On supprime un épisode
	public function deleteEpisodeDb($id)
	{
		$db = $this->dbConnect();
		$delete_episode = $db->prepare('DELETE FROM episodes WHERE id = ?');
    	$delete_episode->execute(array($id));
    	return $delete_episode;
	}

	// On récupère le numéro d'un épisode grâce à son id partagé avec la table commentaires
	public function getEpisodeNumberBack($id)
	{
		$db = $this->dbConnect();
		$back_episode = $db->prepare('SELECT e.episode_number number_episode_episodes FROM episodes e INNER JOIN comments c ON c.id_episode = e.id WHERE c.id = ?');
		$back_episode->execute(array($id));
		$exe_back_episode = $back_episode->fetch();
		$back_episode->closeCursor();
		return $exe_back_episode;
	}
}