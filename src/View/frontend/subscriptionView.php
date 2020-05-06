<?php
$head_title = 'Billet simple pour l\'Alaska - Inscription';
$head_description = 'Inscription au blog Billet simple pour l\'Alaska de Jean Forteroche.';
ob_start();
?>
<section id="subscription" class="identification">
    <h1>INSCRIPTION</h1>
    <h2>Inscrivez-vous pour commenter les épisodes</h2>
    <hr />
    <?php
    if(!isset($_SESSION['pseudo'])) { //On vérifie que la personne n'est pas déjà connectée 
    ?>
        <form action="subscription_post" method="post">
            <p>
                <label for="pseudo">Pseudo</label><br />
                <input type="text" id="pseudo" name="pseudo" minlength = "4" maxlength="20" required>
            </p>
            <p>
                <label for="email">Email</label><br />
                <input type="text" id="email" name="email" required>
            </p>
            <p>
                <label for="password">Mot de passe</label><br />
                <input type="password" id="password" name="password" min="6" required>
            </p>
            <p>
                <label for="password2">Confirmer le mot de passe</label><br />
                <input type="password" id="password2" name="password2" min="6" required>
            </p>
            <p>
                <input class="btn btn__CTA" type="submit" value="S'inscrire">
            </p>
        </form>
        <p class="identification__complement">Vous avez déjà un compte, <a href="index.php?action=login">connectez-vous</a></p>
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