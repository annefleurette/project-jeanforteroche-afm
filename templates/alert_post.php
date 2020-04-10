<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Signaler un commentaire</title>
    </head>
<body>
<?php
// Connexion à la base de données
try
{
$bdd = new PDO('mysql:host=localhost;dbname=novel;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
$alert_all = $bdd->query('SELECT id FROM comments');
$list_alert_all = $alert_all->fetchAll(PDO::FETCH_COLUMN);
$alert_all->closeCursor();
$alert_update = "oui";
$id_comment = intval(htmlspecialchars($_GET['id']));
if(in_array($id_comment, $list_alert_all)) {
	$req = $bdd->prepare('UPDATE comments SET alert = :newalert WHERE id = :id');
	$req->execute(array(
	'newalert' => $alert_update,
	'id' => htmlspecialchars($_GET['id'])
	));
	include("header.php");
	?>
	<p>Le commentaire a été signalé à l'administration</p>
	<a href="episode.php">Retour</a>
	<?php
	include("footer.php");
}else{
	//header('Location: 404error.php');
}
?>
</body>
</html>

