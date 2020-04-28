<?php
namespace AnneFleurMarchat\JeanForteroche\Controller;

// Chargement des classes
require_once('model/EpisodeManager.php');
require_once('model/CommentManager.php');

use AnneFleurMarchat\JeanForteroche\Model\EpisodeManager;
use AnneFleurMarchat\JeanForteroche\Model\CommentManager;

class BackendController {

    public function displayAdmin()
    {
        $episodeManager = new EpisodeManager();
        $commentManager = new CommentManager();
        // On récupère les épisodes publiés
        $published = $episodeManager->getEpisodesPublished();
        $nbepisode_published = count($published);
        // On récupère les épisodes enregistrés
        $inprogress = $episodeManager->getEpisodesInprogress();
        $nbepisode_inprogress = count($inprogress);
        // On récupère les commentaires signalés
        $alert_comments = $commentManager->getCommentsAlert();
        $nbcomment_alert = count($alert_comments);
        // On récupère tous les commentaires
        $published_comments = $commentManager->getComments();
        $nbcomment_published = count($published_comments);
        require('./view/backend/adminView.php');
    }

    public function writeEpisode()
    {
        require('./view/backend/writeView.php');
    }

    public function writeEpisodePost()
    {
        $episodeManager = new EpisodeManager();
        //On compte le nombre d'épisodes qui ont été publiés
        $nbepisodes = $episodeManager->countEpisodesPublished();
        $count_episode_published = intval($nbepisodes);
        $count_episode_publishable = $count_episode_published + 1;
        if(isset($_POST['save']))
        { // Si le bouton Enregistrer est choisi
            // Enregistrement de l'épisode dans la base de données
            // Si les données ont bien été saisies
            if(isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
            {
                //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
                $postnumber = htmlspecialchars($_POST['number']);
                $posttitle = htmlspecialchars($_POST['title']);
                $episode_unitary_published = $episodeManager->getEpisodePublished($postnumber);
                if (empty($episode_unitary_published))
                {
                    // On enregistre le nouvel épisode
                    $req_add_episode = $episodeManager->addEpisodeInprogress($postnumber, $posttitle, $_POST['content']);
                    header('Location: index.php?action=admin');
                }else{
                    echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous avez déjà publié ce numéro d\'épisode !</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="index.php?action=write">Recommencer</a></p></div>';
                }
            }else{
                echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous n\'avez pas rempli tous les champs</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="index.php?action=write">Recommencer</a></p></div>';
            }
        }else{ // Si le bouton Publier est choisi
            // Enregistrement de l'épisode à publier dans la base de données
            // Si les données ont bien été saisies
            if(isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
            {
                // Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés et si ce numéro est bien le +1 du dernier épisode publié
                $postnumber = htmlspecialchars($_POST['number']);
                $posttitle = htmlspecialchars($_POST['title']);
                $episode_unitary_published = $episodeManager->getEpisodePublished($postnumber);
                $current_episode = intval($postnumber);
                if(empty($episode_unitary_published) AND ($current_episode == $count_episode_publishable))
                { // On publie un nouvel épisode
                    $req_add_episode_published = $episodeManager->addEpisodePublished($postnumber, $posttitle, $_POST['content']);
                    header('Location: index.php?action=admin');
                }else{
                    echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous avez déjà publié ce numéro d\'épisode ou cet épisode n\'est pas le suivant du dernier épisode publié !</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="index.php?action=write">Recommencer</a></p></div>';
                }
            }else{
                echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous n\'avez pas rempli tous les champs</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="index.php?action=write">Recommencer</a></p></div>';
            }
        }
    }

    public function deleteEpisode()
    {
        $episodeManager = new EpisodeManager();
        // On supprime un épisode
        $getid = htmlspecialchars($_GET['id']);
        $delete_episode = $episodeManager->deleteEpisodeDb($getid);
        header('Location: index.php?action=admin');
    }

    public function updateEpisode()
    {
        $episodeManager = new EpisodeManager();
        // On affiche l'épisode que l'on va chercher sur la base de données
        $getid = htmlspecialchars($_GET['id']);
        $episode_unitary = $episodeManager->getEpisode($getid);
        require('./view/backend/updateView.php');
    }

    public function updateEpisodePost()
    {
        $episodeManager = new EpisodeManager();
        // On compte le nombre d'épisodes qui ont été publiés
        $nbepisodes = $episodeManager->countEpisodesPublished();
        $count_episode_published = intval($nbepisodes);
        $count_episode_publishable = $count_episode_published + 1;
        if(isset($_POST['save']))
        {   // Si le bouton Enregistrer est choisi
            // Enregistrement de l'épisode à modifier dans la base de données
            // Si les données ont bien été saisies
            if (isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
            {
                //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
                $postnumber = htmlspecialchars($_POST['number']);
                $posttitle = htmlspecialchars($_POST['title']);
                $getid = htmlspecialchars($_GET['id']);
                $episode_unitary_published = $episodeManager->getEpisodePublished($postnumber);
                $status_progress = "inprogress";
                if (empty($episode_unitary_published))
                {
                    // On enregistre la modification dans la base de données
                    $update_episode_inprogress = $episodeManager->updateEpisodeInprogress($postnumber, $posttitle, $_POST['content'], $status_progress, $getid); 
                    header('Location: index.php?action=admin');
                }else{
                    echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous avez déjà publié ce numéro d\'épisode</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="index.php?action=admin">Recommencer</a></p></div>';
                }
            }else{
                echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous n\'avez pas rempli tous les champs</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="index.php?action=admin">Recommencer</a></p></div>';
            }
        } else { // Si le bouton Publier est choisi
        // Enregistrement de l'épisode à publier dans la base de données
        // Si les données ont bien été saisies
            if (isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
            { // Cas d'un épisode enregistré que l'on va publier
                // Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés et si ce numéro est bien le +1 du dernier épisode publié
                $postnumber = htmlspecialchars($_POST['number']);
                $posttitle = htmlspecialchars($_POST['title']);
                $getid = htmlspecialchars($_GET['id']);
                $episode_unitary_published = $episodeManager->getEpisodePublished($_POST['number']);
                $current_episode = intval($postnumber);
                $status_published = "published";
                if (empty($episode_unitary_published) AND ($current_episode == $count_episode_publishable))
                {
                    // On enregistre la modification dans la base de données
                    $update_episode_inprogress = $episodeManager->updateEpisodeInprogress($postnumber, $posttitle, $_POST['content'], $status_published, $getid); 
                    header('Location: index.php?action=admin');
                }else{
                    echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous avez déjà publié ce numéro d\'épisode ou cet épisode n\'est pas le suivant du dernier épisode publié !</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="index.php?action=admin">Recommencer</a></p></div>';
                }
            }elseif(!isset($_POST['number']) AND isset($_POST['title']) AND isset($_POST['content']))
            {
                // Actualisation de l'épisode déjà publié
                $postitle = htmlspecialchars($_POST['title']);
                $getid = htmlspecialchars($_GET['id']);
                $update_episode_published = $episodeManager->updateEpisodePublished($posttitle, $_POST['content'], $getid);
                header('Location: index.php?action=admin');
            }      
        }
    }

    public function lookEpisode()
    {
        $episodeManager = new EpisodeManager();
        // On récupère l'épisode dans la base de données
        $getid = htmlspecialchars($_GET['id']);
        $lookepisode = $episodeManager->getEpisodeInprogress($getid);
        require('./view/backend/lookView.php');
    }

    public function alertCommentPost()
    {
        $episodeManager = new EpisodeManager();
        $commentManager = new CommentManager();
        // On récupère tous les id des commentaires
        $list_alert_all = $commentManager->getCommentsId();
        $alert_update = "oui";
        $getid = htmlspecialchars($_GET['id']);
        $id_comment = intval($getid);
        if(in_array($id_comment, $list_alert_all)) // On regarde si le commentaire est bien dans la base de données
        {
            // On modifie le statut d'alerte d'un commentaire
            $update_alert = $commentManager->updateCommentAlert($alert_update, $getid);
            echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Le commentaire a été signalé à l\'administration</p></div>';
            // On retourne sur l'épisode
            $exe_back_episode = $episodeManager->getEpisodeNumberBack($getid);
            echo '<p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="index.php?action=episode&number=' .$exe_back_episode['number_episode_episodes'].'">Retour</a></p>';
        }else{
            throw new \Exception('Erreur');
        }
    }

    public function alertCommentCancel()
    {
        $commentManager = new CommentManager();
        $list_alert_all = $commentManager->getCommentsId();
        $alert_update = "non";
        $getid = htmlspecialchars($_GET['id']);
        $id_comment = intval($getid);
        if(in_array($id_comment, $list_alert_all)) // On regarde si le commentaire est bien dans la base de données
        {
            // On modifie le statut d'alerte d'un commentaire
            $update_alert = $commentManager->updateCommentAlert($alert_update, $getid);
            echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Le commentaire n\'est plus signalé</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="index.php?action=admin">Retour</a></p></div>';
        }else{
            throw new \Exception('Erreur');
        }
    }

    public function deleteComment()
    {
        $commentManager = new CommentManager();
        // On supprime le commentaire
        $getid = htmlspecialchars($_GET['id']);
        $delete_comment = $commentManager->deleteCommentDb($getid);
        header('Location: index.php?action=admin');
    }

}