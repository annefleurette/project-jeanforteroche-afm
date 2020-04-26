
<header> <!-- Barre de navigation qui intègre un bouton permettant à Jean Forteroche de se connecter à son espace personnel -->
    <a href="index.php"><img src="./public/images/logo.png" alt="Jean Forteroche"></a>
    <p>Jean Forteroche</p>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php?action=episode">Tous les épisodes</a></li>
            <?php if (isset($_SESSION['pseudo']) AND $_SESSION['type'] == "admin") {
            ?>
                <li><a href="index.php?action=admin">Administration</a></li>
                <li><a href="index.php?action=logout">Se déconnecter</a></li>
            <?php
            } elseif (isset($_SESSION['pseudo']) AND $_SESSION['type'] == "reader") {
            ?>
                <li><a href="index.php?action=logout">Se déconnecter</a></li>
            <?php
            } else {
            ?>
                <li><a href="index.php?action=subscription">Inscription</a></li>
                <li><a href="index.php?action=login">Connexion</a></li>
            <?php
            }
            ?>
        </ul>
	</nav>
</header>