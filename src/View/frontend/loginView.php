<?php
$head_title = 'Billet simple pour l\'Alaska - Connexion';
$head_descripion = 'Connexion à l\'espace membre du roman Billet simple pour l\'Alaska de Jean Forteroche.';
ob_start();
?>
<section id="member-login" class="identification">
    <h1>CONNEXION</h1>
    <h2>Connectez-vous pour interagir avec la communauté de lecteurs</h2>
    <hr />
    <?php
    if(!isset($_SESSION['pseudo'])) { //On vérifie que la personne n'est pas déjà connectée
    ?>
        <form action="login_post" method="post">
            <p>
                <label for="email">Identifiant email</label><br />
                <input type="text" id="email" name="email" required>
            </p>
            <p>
                <label for="password">Mot de passe</label><br />
                <input type="password" name="password" id="password" required>
            </p>
            <p>
                <input class="btn btn__CTA" type="submit" value="Se connecter">
            </p>
            <p>
                <input class="remember-input" type="checkbox" id="remember" name="remember">
                <label for="remember">Se souvenir de moi</label>
            </p>
        </form>
    <?php
    }else{
    ?>
        <p class="identification__complement">Vous êtes déjà inscrit(e) et connecté(e) !
    <?php
    }
    ?>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>