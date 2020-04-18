<?php
$head_title = 'Billet simple pour l\'Alaska - Connexion';
$head_descripion = 'Connexion à l\'espace membre du roman Billet simple pour l\'Alaska de Jean Forteroche.';
ob_start();
?>
<section id="member-login">
    <?php
    if (!isset($_POST['email']) OR (!isset($_POST['password']))) { // Si le pseudo ou le mot de passe n'a pas été saisi, on affiche le formulaire
    ?>
        <form action="login.php" method="post">
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
    }else{ // Traitement du cas des membres inscrits
        if(!$info_member){
        ?>
            <p>Mauvais identifiant ou mot de passe</p>
                <form action="login.php" method="post">
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
            if ($isPasswordCorrect){
                session_start();
                $_SESSION['pseudo'] = $info_member['pseudo'];
                $_SESSION['type'] = $info_member['type'];
                setcookie(htmlspecialchars($_POST['email']), time()+365*24*3600, null, null, false, true);
                setcookie(htmlspecialchars(password_verify($_POST['password'], $info_member['password'])), time()+365*24*3600, null, null, false, true);
                if($info_member['type'] == "admin"){ // Si le membre est admin
                    header('Location: index.php?action=admin'); 
                }else{ // Si le membre est reader
                    header('Location: index.php?action=episode');
                }
            }else{
            ?>
                <p>Mauvais identifiant ou mot de passe</p>
                <form action="login.php" method="post">
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
            }
        }
    }
    ?>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>