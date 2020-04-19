<?php

function displayAdmin()
{
    // On récupère les épisodes publiés
    $published = getEpisodesPublished();
    $nbepisode_published = count($published);
    // On récupère les épisodes enregistrés
    $inprogress = getEpisodesInprogress();
    $nbepisode_inprogress = count($inprogress);
    // On récupère les commentaires signalés
    $alert_comments = getCommentsAlert();
    $nbcomment_alert = count($alert_comments);
    // On récupère tous les commentaires
    $published_comments = getComments();
    $nbcomment_published = count($published_comments);
    require('./view/backend/adminView.php');
}

function writeEpisode()
{
    require('./view/backend/writeView.php');
}

function writeEpisodePost()
{
    //On compte le nombre d'épisodes qui ont été publiés
    $nbepisodes = countEpisodesPublished();
    $count_episode_published = intval($nbepisodes['numberEpisodes']);
    $count_episode_publishable = $count_episode_published + 1;
    if(isset($_POST['save']))
    { // Si le bouton Enregistrer est choisi
        // Enregistrement de l'épisode dans la base de données
        // Si les données ont bien été saisies
        if(isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
        {
            //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
            $episode_unitary_published = getEpisodePublished($_POST['number']);
            $_POST['number'] = htmlspecialchars($_POST['number']);
            $_POST['title'] = htmlspecialchars($_POST['title']);
            if (empty($episode_unitary_published))
            {
                // On enregistre le nouvel épisode
                $req_add_episode = addEpisodeInprogress($_POST['number'], $_POST['title'], $_POST['content']);
                header('Location: index.php?action=admin');
            }else{
                echo '<div class="error-message"><p>Vous avez déjà publié ce numéro d\'épisode !</p><p><a href="index.php?action=write">Recommencer</a></p></div>';
            }
        }else{
            echo '<div class="error-message"><p>Vous n\'avez pas rempli tous les champs</p><p><a href="index.php?action=write">Recommencer</a></p></div>';
        }
    }else{ // Si le bouton Publier est choisi
        // Enregistrement de l'épisode à publier dans la base de données
        // Si les données ont bien été saisies
        if(isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
        {
            // Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés et si ce numéro est bien le +1 du dernier épisode publié
            $episode_unitary_published = getEpisodePublished($_POST['number']);
            $current_episode = intval($_POST['number']);
            $_POST['number'] = htmlspecialchars($_POST['number']);
            $_POST['title'] = htmlspecialchars($_POST['title']);
            if(empty($episode_unitary_published) AND ($current_episode == $count_episode_publishable))
            { // On publie un nouvel épisode
                $req_add_episode_published = addEpisodePublished($_POST['number'], $_POST['title'], $_POST['content']);
                header('Location: index.php?action=admin');
            }else{
                echo '<div class="error-message"><p>Vous avez déjà publié ce numéro d\'épisode ou cet épisode n\'est pas le suivant du dernier épisode publié !</p><p><a href="index.php?action=write">Recommencer</a></p></div>';
            }
        }else{
            echo '<div class="error-message"><p>Vous n\'avez pas rempli tous les champs</p><p><a href="index.php?action=write">Recommencer</a></p></div>';
        }
    }
}

function deleteEpisodePost()
{
    // On supprime un épisode
    $_GET['id'] = htmlspecialchars($_GET['id']);
    $delete_episode = deleteEpisode($_GET['id']);
    header('Location: index.php?action=admin');
}
