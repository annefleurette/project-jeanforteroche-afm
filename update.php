<?php
session_start();
if(isset($_GET['id'])){
   include "templates/update.php"; 
} else {
    include "templates/404error.php";
}
?>
