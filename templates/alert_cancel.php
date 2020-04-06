<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="style.css" />
        <title>Billet simple pour l'Alaska - Enlever le signalement d'un commentaire</title>
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
$list_alert_all = $alert_all->fetchAll();
$alert_all->closeCursor();
$alert_update = "non";
$id_comment = intval($_GET['number']);
	$req = $bdd->prepare('UPDATE comments SET alert = :newalert WHERE id = :id');
	$req->execute(array(
	'newalert' => $alert_update,
	'id' => $_GET['number']
	));
	include("header.php");
	?>
	<p>Le commentaire n'est plus signalé</p>
	<a href="admin.php">Retour</a>
	<?php
	include("footer.php");
?>
</body>
</html>

