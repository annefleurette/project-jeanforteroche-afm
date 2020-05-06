
<header> <!-- Barre de navigation qui intègre un bouton permettant à Jean Forteroche de se connecter à son espace personnel -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="index">
            <img src="<?php echo $GLOBALS['root']; ?>/public/images/logo.png" class="d-inline-block align-top" alt="Jean Forteroche">Jean Forteroche
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fas fa-bars"></i> 
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav p-2">
                <li class="nav-item left-part active">
                    <a class="nav-link" href="index"><i class="fas fa-home"></i>Accueil<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item left-part">
                    <a class="nav-link" href="episode">Tous les épisodes</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto p-2">
                <?php if (isset($_SESSION['pseudo']) AND $_SESSION['type'] == "admin")
                {
                ?>
                    <li class="nav-item right-part administration">
                        <a class="nav-link" href="admin">Administration</a>
                    </li>
                    <li class="nav-item right-part">
                        <a class="nav-link" href="logout">Se déconnecter</a>
                    </li>
                <?php
                } elseif (isset($_SESSION['pseudo']) AND $_SESSION['type'] == "reader")
                {
                ?>
                    <li class="nav-item right-part">
                        <a class="nav-link" href="logout">Se déconnecter</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item right-part subscription">
                        <a class="nav-link" href="subscription">Inscription</a>
                    </li>
                    <li class="nav-item right-part login">
                        <a class="nav-link" href="login">Connexion</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>  
</header>