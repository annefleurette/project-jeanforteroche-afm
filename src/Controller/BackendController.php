<?php
namespace AnneFleurMarchat\JeanForteroche\Controller;

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
        require('./src/View/backend/adminView.php');
    }

    public function writeEpisode()
    {
        require('./src/View/backend/writeView.php');
    }

    public function writeEpisodePost($postsave, $postnumber, $posttitle, $postcontent)
    {
        $episodeManager = new EpisodeManager();
        //On compte le nombre d'épisodes qui ont été publiés
        $nbepisodes = $episodeManager->countEpisodesPublished();
        $count_episode_published = intval($nbepisodes);
        $count_episode_publishable = $count_episode_published + 1;
        if(isset($postsave))
        { // Si le bouton Enregistrer est choisi
            // Enregistrement de l'épisode dans la base de données
            // Si les données ont bien été saisies
            if(isset($postnumber) AND isset($posttitle) AND isset($postcontent))
            {
                //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
                $postnumber = htmlspecialchars($postnumber);
                $posttitle = htmlspecialchars($posttitle);
                $episode_unitary_published = $episodeManager->getEpisodePublished($postnumber);
                if (empty($episode_unitary_published))
                {
                    // On enregistre le nouvel épisode
                    $req_add_episode = $episodeManager->addEpisodeInprogress($postnumber, $posttitle, $postcontent);
                    header('Location: http://www.jeanforteroche.com/admin');
                }else{
                    echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous avez déjà publié ce numéro d\'épisode !</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/write">Recommencer</a></p></div>';
                }
            }else{
                echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous n\'avez pas rempli tous les champs</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/write">Recommencer</a></p></div>';
            }
        }else{ // Si le bouton Publier est choisi
            // Enregistrement de l'épisode à publier dans la base de données
            // Si les données ont bien été saisies
            if(isset($postnumber) AND isset($posttitle) AND isset($postcontent))
            {
                // Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés et si ce numéro est bien le +1 du dernier épisode publié
                $postnumber = htmlspecialchars($postnumber);
                $posttitle = htmlspecialchars($posttitle);
                $episode_unitary_published = $episodeManager->getEpisodePublished($postnumber);
                $current_episode = intval($postnumber);
                if(empty($episode_unitary_published) AND ($current_episode == $count_episode_publishable))
                { // On publie un nouvel épisode
                    $req_add_episode_published = $episodeManager->addEpisodePublished($postnumber, $posttitle, $postcontent);
                    header('Location: http://www.jeanforteroche.com/admin');
                }else{
                    echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous avez déjà publié ce numéro d\'épisode ou cet épisode n\'est pas le suivant du dernier épisode publié !</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/write">Recommencer</a></p></div>';
                }
            }else{
                echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous n\'avez pas rempli tous les champs</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/write">Recommencer</a></p></div>';
            }
        }
    }

    public function deleteEpisode($getid)
    {
        $episodeManager = new EpisodeManager();
        // On supprime un épisode
        $getid = htmlspecialchars($getid);
        $delete_episode = $episodeManager->deleteEpisodeDb($getid);
        header('Location: http://www.jeanforteroche.com/admin');
    }

    public function updateEpisode($getid)
    {
        $episodeManager = new EpisodeManager();
        // On affiche l'épisode que l'on va chercher sur la base de données
        $getid = htmlspecialchars($getid);
        $episode_unitary = $episodeManager->getEpisode($getid);
        require('./src/View/backend/updateView.php');
    }

    public function updateEpisodePost($postsave, $postnumber, $posttitle, $postcontent, $getid)
    {
        $episodeManager = new EpisodeManager();
        // On compte le nombre d'épisodes qui ont été publiés
        $nbepisodes = $episodeManager->countEpisodesPublished();
        $count_episode_published = intval($nbepisodes);
        $count_episode_publishable = $count_episode_published + 1;
        if(isset($postsave))
        {   // Si le bouton Enregistrer est choisi
            // Enregistrement de l'épisode à modifier dans la base de données
            // Si les données ont bien été saisies
            if (isset($postnumber) AND isset($posttitle) AND isset($postcontent))
            {
                //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
                $postnumber = htmlspecialchars($postnumber);
                $posttitle = htmlspecialchars($posttitle);
                $getid = htmlspecialchars($getid);
                $episode_unitary_published = $episodeManager->getEpisodePublished($postnumber);
                $status_progress = "inprogress";
                if (empty($episode_unitary_published))
                {
                    // On enregistre la modification dans la base de données
                    $update_episode_inprogress = $episodeManager->updateEpisodeInprogress($postnumber, $posttitle, $postcontent, $status_progress, $getid); 
                    header('Location: http://www.jeanforteroche.com/admin');
                }else{
                    echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous avez déjà publié ce numéro d\'épisode</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/admin">Recommencer</a></p></div>';
                }
            }else{
                echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous n\'avez pas rempli tous les champs</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/admin">Recommencer</a></p></div>';
            }
        } else { // Si le bouton Publier est choisi
        // Enregistrement de l'épisode à publier dans la base de données
        // Si les données ont bien été saisies
            if (isset($postnumber) AND isset($posttitle) AND isset($postcontent))
            { // Cas d'un épisode enregistré que l'on va publier
                // Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés et si ce numéro est bien le +1 du dernier épisode publié
                $postnumber = htmlspecialchars($postnumber);
                $posttitle = htmlspecialchars($posttitle);
                $getid = htmlspecialchars($getid);
                $episode_unitary_published = $episodeManager->getEpisodePublished($postnumber);
                $current_episode = intval($postnumber);
                $status_published = "published";
                if (empty($episode_unitary_published) AND ($current_episode == $count_episode_publishable))
                {
                    // On enregistre la modification dans la base de données
                    $update_episode_inprogress = $episodeManager->updateEpisodeInprogress($postnumber, $posttitle, $postcontent, $status_published, $getid); 
                    header('Location: http://www.jeanforteroche.com/admin');
                }else{
                    echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous avez déjà publié ce numéro d\'épisode ou cet épisode n\'est pas le suivant du dernier épisode publié !</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/admin">Recommencer</a></p></div>';
                }
            }elseif(!isset($postnumber) AND isset($postitle) AND isset($postcontent))
            {
                // Actualisation de l'épisode déjà publié
                $posttitle = htmlspecialchars($postitle);
                $getid = htmlspecialchars($getid);
                $update_episode_published = $episodeManager->updateEpisodePublished($posttitle, $postcontent, $getid);
                header('Location: http://www.jeanforteroche.com/admin');
            }      
        }
    }

    public function lookEpisode($getid)
    {
        $episodeManager = new EpisodeManager();
        // On récupère l'épisode dans la base de données
        $getid = htmlspecialchars($getid);
        $lookepisode = $episodeManager->getEpisodeInprogress($getid);
        require('./src/View/backend/lookView.php');
    }

    public function alertCommentPost($getid)
    {
        $episodeManager = new EpisodeManager();
        $commentManager = new CommentManager();
        // On récupère tous les id des commentaires
        $list_alert_all = $commentManager->getCommentsId();
        $alert_update = "oui";
        $getid = htmlspecialchars($getid);
        $id_comment = intval($getid);
        if(in_array($id_comment, $list_alert_all)) // On regarde si le commentaire est bien dans la base de données
        {
            // On modifie le statut d'alerte d'un commentaire
            $update_alert = $commentManager->updateCommentAlert($alert_update, $getid);
            echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Le commentaire a été signalé à l\'administration</p></div>';
            // On retourne sur l'épisode
            $exe_back_episode = $episodeManager->getEpisodeNumberBack($getid);
            echo '<p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/episode/number-' .$exe_back_episode['number_episode_episodes'].'">Retour</a></p>';
        }else{
            throw new \Exception('Erreur');
        }
    }

    public function alertCommentCancel($getid)
    {
        $commentManager = new CommentManager();
        $list_alert_all = $commentManager->getCommentsId();
        $alert_update = "non";
        $getid = htmlspecialchars($getid);
        $id_comment = intval($getid);
        if(in_array($id_comment, $list_alert_all)) // On regarde si le commentaire est bien dans la base de données
        {
            // On modifie le statut d'alerte d'un commentaire
            $update_alert = $commentManager->updateCommentAlert($alert_update, $getid);
            echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Le commentaire n\'est plus signalé</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/admin">Retour</a></p></div>';
        }else{
            throw new \Exception('Erreur');
        }
    }

    public function deleteComment($getid)
    {
        $commentManager = new CommentManager();
        // On supprime le commentaire
        $getid = htmlspecialchars($getid);
        $delete_comment = $commentManager->deleteCommentDb($getid);
        header('Location: http://www.jeanforteroche.com/admin');
    }

}