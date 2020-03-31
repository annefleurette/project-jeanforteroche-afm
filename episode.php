<?php
session_start();
if(!isset($_GET['number'])){
   include "templates/episodes.php"; 
} else {
    include "templates/episode.php";
}
?>
