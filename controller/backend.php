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
    $count_episode_published = intval($nbepisodes);
    $count_episode_publishable = $count_episode_published + 1;
    if(isset($_POST['save']))
    { // Si le bouton Enregistrer est choisi
        // Enregistrement de l'épisode dans la base de données
        // Si les données ont bien été saisies
        if(isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
        {
            //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
            $_POST['number'] = htmlspecialchars($_POST['number']);
            $_POST['title'] = htmlspecialchars($_POST['title']);
            $episode_unitary_published = getEpisodePublished($_POST['number']);
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
            $_POST['number'] = htmlspecialchars($_POST['number']);
            $_POST['title'] = htmlspecialchars($_POST['title']);
            $episode_unitary_published = getEpisodePublished($_POST['number']);
            $current_episode = intval($_POST['number']);
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

function deleteEpisode()
{
    // On supprime un épisode
    $_GET['id'] = htmlspecialchars($_GET['id']);
    $delete_episode = deleteEpisodeDb($_GET['id']);
    header('Location: index.php?action=admin');
}

function updateEpisode()
{
    // On affiche l'épisode que l'on va chercher sur la base de données
    $_GET['id'] = htmlspecialchars($_GET['id']);
    $episode_unitary = getEpisode($_GET['id']);
    require('./view/backend/updateView.php');
}

function updateEpisodePost()
{
    // On compte le nombre d'épisodes qui ont été publiés
    $nbepisodes = countEpisodesPublished();
    $count_episode_published = intval($nbepisodes);
    $count_episode_publishable = $count_episode_published + 1;
    if(isset($_POST['save']))
    {   // Si le bouton Enregistrer est choisi
        // Enregistrement de l'épisode à modifier dans la base de données
        // Si les données ont bien été saisies
        if (isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
        {
            //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
            $_POST['number'] = htmlspecialchars($_POST['number']);
            $_POST['title'] = htmlspecialchars($_POST['title']);
            $_GET['id'] = htmlspecialchars($_GET['id']);
            $episode_unitary_published = getEpisodePublished($_POST['number']);
            $status_progress = "inprogress";
            if (empty($episode_unitary_published))
            {
                // On enregistre la modification dans la base de données
                $update_episode_inprogress = updateEpisodeInprogress($_POST['number'], $_POST['title'], $_POST['content'], $status_progress, $_GET['id']); 
                header('Location: index.php?action=admin');
            }else{
                echo '<div class="error-message"><p>Vous avez déjà publié ce numéro d\'épisode</p><p><a href="index.php?action=admin">Recommencer</a></p></div>';
            }
        }else{
            echo '<div class="error-message"><p>Vous n\'avez pas rempli tous les champs</p><p><a href="index.php?action=admin">Recommencer</a></p></div>';
        }
    } else { // Si le bouton Publier est choisi
    // Enregistrement de l'épisode à publier dans la base de données
    // Si les données ont bien été saisies
        if (isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
        { // Cas d'un épisode enregistré que l'on va publier
            // Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés et si ce numéro est bien le +1 du dernier épisode publié
            $_POST['number'] = htmlspecialchars($_POST['number']);
            $_POST['title'] = htmlspecialchars($_POST['title']);
            $_GET['id'] = htmlspecialchars($_GET['id']);
            $episode_unitary_published = getEpisodePublished($_POST['number']);
            $current_episode = intval($_POST['number']);
            $status_published = "published";
            if (empty($episode_unitary_published) AND ($current_episode == $count_episode_publishable))
            {
                // On enregistre la modification dans la base de données
                $update_episode_inprogress = updateEpisodeInprogress($_POST['number'], $_POST['title'], $_POST['content'], $status_published, $_GET['id']); 
                header('Location: index.php?action=admin');
            }else{
                echo '<div class="error-message"><p>Vous avez déjà publié ce numéro d\'épisode ou cet épisode n\'est pas le suivant du dernier épisode publié !</p><p><a href="index.php?action=admin">Recommencer</a></p></div>';
            }
        }elseif(!isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
        {
            // Actualisation de l'épisode déjà publié
            $_POST['number'] = htmlspecialchars($_POST['number']);
            $_POST['title'] = htmlspecialchars($_POST['title']);
            $_GET['id'] = htmlspecialchars($_GET['id']);
            $update_episode_published = updateEpisodePublished($_POST['title'], $_POST['content'], $_GET['id']);
            header('Location: index.php?action=admin');
        }      
    }
}

function lookEpisode()
{
    // On récupère l'épisode dans la base de données
    $_GET['id'] = htmlspecialchars($_GET['id']);
    $lookepisode = getEpisodeInprogress($_GET['id']);
    require('./view/backend/lookView.php');
}

function alertCommentPost()
{
    // On récupère tous les id des commentaires
    $list_alert_all = getCommentsId();
    $alert_update = "oui";
    $_GET['id'] = htmlspecialchars($_GET['id']);
    $id_comment = intval(htmlspecialchars($_GET['id']));
    if(in_array($id_comment, $list_alert_all)) // On regarde si le commentaire est bien dans la base de données
    {
        // On modifie le statut d'alerte d'un commentaire
        $update_alert = updateCommentAlert($alert_update, $_GET['id']);
        echo '<div class="confirmation-message"><p>Le commentaire a été signalé à l\'administration</p></div>';
        // On retourne sur l'épisode
        $exe_back_episode = getEpisodeNumberBack($_GET['id']);
        echo '<p><a href="index.php?action=episode&amp;number=' .$exe_back_episode['number_episode_episodes'].'">Retour</a></p>';
    }else{
	    throw new Exception('Erreur');
    }
}

function alertCommentCancel()
{
    $list_alert_all = getCommentsId();
    $alert_update = "non";
    $_GET['id'] = htmlspecialchars($_GET['id']);
    $id_comment = intval(htmlspecialchars($_GET['id']));
    if(in_array($id_comment, $list_alert_all)) // On regarde si le commentaire est bien dans la base de données
    {
        // On modifie le statut d'alerte d'un commentaire
        $update_alert = updateCommentAlert($alert_update, $_GET['id']);
        echo '<div class="confirmation-message"><p>Le commentaire n\'est plus signalé</p><p><a href="index.php?action=admin">Retour</a></p></div>';
    }else{
	    throw new Exception('Erreur');
    }
}

function deleteComment()
{
    // On supprime le commentaire
    $_GET['id'] = htmlspecialchars($_GET['id']);
    $delete_comment = deleteCommentDb($_GET['id']);
    header('Location: index.php?action=admin');
}