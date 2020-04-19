<?php
$head_title = 'Billet simple pour l\'Alaska - Connexion';
$head_descripion = 'Connexion à l\'espace membre du roman Billet simple pour l\'Alaska de Jean Forteroche.';
ob_start();
?>
<section id="member-login">
    <h1>Connexion</h1>
    <?php
    if(!isset($_SESSION['pseudo'])) { //On vérifie que la personne n'est pas déjà connectée
    ?>
        <form action="index.php?action=login_post" method="post">
            <p>
                <label for="email">Identifiant email :</label>
                <input type="text" id="email" name="email" required>
            </p>
            <p>
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" required>
            </p>
            <p>
                <input type="submit" value="Se connecter">
            </p>
        </form>
    <?php
    }else{
    ?>
        <p>Vous êtes déjà inscrit(e) et connecté(e) !
    <?php
    }
    ?>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>