<?php
namespace AnneFleurMarchat\JeanForteroche\Model;
//require_once("model/Manager.php");
use AnneFleurMarchat\JeanForteroche\Model\Manager;
class MemberManager extends Manager
{

	// On récupère l'id d'un pseudo de membre
	public function getMemberId($pseudo)
	{
		$db = $this->dbConnect();
		$req_idpseudo = $db->prepare('SELECT id FROM members WHERE pseudo = ?');
	    $req_idpseudo->execute(array($pseudo));
	    $exe_idpseudo = $req_idpseudo->fetch(\PDO::FETCH_COLUMN);
	    $req_idpseudo->closeCursor();
	    return $exe_idpseudo;
	}

	// On récupère tous les pseudos des membres inscrits
	public function getMembersPseudo()
	{
		$db = $this->dbConnect();
		$req_pseudos = $db->query('SELECT pseudo FROM members');
	    $exe_pseudos = $req_pseudos->fetchAll(\PDO::FETCH_COLUMN);
	    $req_pseudos->closeCursor();
	    return $exe_pseudos;
	}

	// On récupère tous les emails des membres inscrits
	public function getMembersEmail()
	{
		$db = $this->dbConnect();
		$req_emails = $db->query('SELECT email FROM members');
	    $exe_emails = $req_emails->fetchAll(\PDO::FETCH_COLUMN);
	    $req_emails->closeCursor();
	    return $exe_emails;
	}

	// On récupère l'eamil d'un membre sur la base de son pseudo
	public function getMemberEmail($pseudo)
	{
		$db = $this->dbConnect();
		$req_email = $db->query('SELECT email FROM members WHERE pseudo = ?');
		$req_email->execute(array($pseudo));
	    $exe_email = $req_email->fetch;
	    $req_email->closeCursor();
	    return $exe_email;
	}

	// On récupère les informations de membre qui correspondent à l'email saisi
	public function getMemberInfo($email)
	{
		$db = $this->dbConnect();
		$req_member = $db->prepare('SELECT pseudo, password, type FROM members WHERE email = ?');
	    $req_member->execute(array($email));
	    $info_member = $req_member->fetch();
	    $req_member->closeCursor();
	    return $info_member;
	}

	// On enregistre un nouveau membre dans la base de données
	public function addMember($pseudo, $password, $email)
	{
		$db = $this->dbConnect();
		$newmember = $db->prepare('INSERT INTO members (pseudo, password, email, date_subscription, type) VALUES(?, ?, ?, CURDATE(), \'reader\')');
	    $newmember->execute(array($pseudo, $password, $email));
	    return $newmember;
	}

	// On supprime un membre de la base de données
	public function deleteMemberDb($pseudo)
	{
		$db = $this->dbConnect();
		$delete_member = $db->prepare('DELETE FROM members WHERE pseudo = ?');
	    $delete_member->execute(array($pseudo));
	    return $delete_member;
	}
}