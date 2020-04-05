<?php
session_start();
if(isset($_GET['number'])){
   include "templates/update.php"; 
} else {
    include "templates/404error.php";
}
?>
