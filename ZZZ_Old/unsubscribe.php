<?php
session_start();
if(isset($_SESSION['pseudo'])){
   include "templates/unsubscribe.php"; 
} else {
    include "templates/404error.php";
}
?>