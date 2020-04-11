<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" href="style.css" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

