<?php
require('controller/frontend.php');
require('controller/backend.php');
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listEpisodeFirst') {
            listEpisodeFirst();
        }
        elseif ($_GET['action'] == 'listEpisodesLastThree') {
            listEpisodesLastThree();
    }
    else {
        
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}