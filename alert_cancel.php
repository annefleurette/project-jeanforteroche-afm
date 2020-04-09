<?php
session_start();
if(isset($_GET['id'])){
   include "templates/alert_cancel.php"; 
} else {
    include "templates/404error.php";
}
?>

