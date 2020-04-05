
<header> <!-- Barre de navigation qui intègre un bouton permettant à Jean Forteroche de se connecter à son espace personnel -->
    <a href="index.php"><img src="images/logo.png" alt="Jean Forteroche"></a>
    <p>Jean Forteroche</p>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="episode.php">Tous les épisodes</a></li>
            <?php if (isset($_SESSION['pseudo'])) {
            ?>
                <li><a href="admin.php">Administration</a></li>
                <li><a href="logout.php">Se déconnecter</a></li>
            <?php
            } else {
            ?>
                <li><a href="subscription.php">Inscription</a></li>
                <li><a href="login.php">Connexion</a></li>
            <?php
            }
            ?>
        </ul>
	</nav>
</header>