<?php
session_start();
if(isset($_GET['number'])){
   include "templates/delete_episode.php"; 
} else {
    include "templates/404error.php";
}
?>
