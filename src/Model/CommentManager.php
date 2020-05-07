<?php
namespace AnneFleurMarchat\JeanForteroche\Model;
class CommentManager extends Manager
{

	// On récupère les commentaires signalés
	public function getCommentsAlert()
	{
	    $db = $this->dbConnect();
	    $comments = $db->query('SELECT c.id id_comments, e.episode_number episod_number_episodes, m.pseudo pseudo_members, c.comment comment_comments, DATE_FORMAT(c.date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM members m INNER JOIN comments c ON c.id_pseudo = m.id INNER JOIN episodes e  ON c.id_episode = e.id WHERE c.alert = "oui" ORDER BY c.date_comment');
	    $alert_comments = $comments->fetchAll();
	    $comments->closeCursor();
	    return $alert_comments;
	}

	// On récupère tous les commentaires
	public function getComments()
	{
	    $db = $this->dbConnect();
	    $comment = $db->query('SELECT c.id id_comments, e.episode_number episod_number_episodes, m.pseudo pseudo_members, c.comment comment_comments, DATE_FORMAT(c.date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM members m INNER JOIN comments c ON c.id_pseudo = m.id INNER JOIN episodes e  ON c.id_episode = e.id ORDER BY c.date_comment');
	    $published_comments = $comment->fetchAll();
	    $comment->closeCursor();
	    return $published_comments;
	}

	// On récupère les commentaires d'un épisode
	public function getEpisodeComment($id)
	{
		$db = $this->dbConnect();
		$comment_recup = $db->prepare('SELECT m.pseudo pseudo_members, c.comment comment_comments, c.id id_comments, DATE_FORMAT(c.date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM members m INNER JOIN comments c ON m.id = c.id_pseudo WHERE c.id_episode = ? ORDER BY date_comment');
	    $comment_recup->execute(array($id));
	    $comments = $comment_recup->fetchAll();
	    $comment_recup->closeCursor();
	    return $comments;
	}

	// On récupère tous les id des commentaires
	public function getCommentsId()
	{
		$db = $this->dbConnect();
		$alert_all = $db->query('SELECT id FROM comments');
		$list_alert_all = $alert_all->fetchAll(\PDO::FETCH_COLUMN);
		$alert_all->closeCursor();
		return $list_alert_all;
	}

	// On modifie le statut d'alerte d'un commentaire
	public function updateCommentAlert($alert, $id)
	{
		$db = $this->dbConnect();
		$update_alert = $db->prepare('UPDATE comments SET alert = :newalert WHERE id = :id');
		$update_alert->execute(array(
			'newalert' => $alert,
			'id' => $id
		));
		return $update_alert;
	}

	// On enregistre le commentaire dans la base de données
	public function postComment($idepisode, $idpseudo, $comment)
		{
			$db = $this->dbConnect();
			$newcomment = $db->prepare('INSERT INTO comments (id_episode, id_pseudo, comment, date_comment) VALUES(?, ?, ?, NOW())');
			$newcomment->execute(array($idepisode, $idpseudo, $comment));
			return $newcomment;
		}

	// On supprime un commentaire
	public function deleteCommentDb($id)
	{
		$db = $this->dbConnect();
		$delete_comment = $db->prepare('DELETE FROM comments WHERE id = ?');
		$delete_comment->execute(array($id));
		return $delete_comment;
	}	
}