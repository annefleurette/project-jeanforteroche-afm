<?php
session_start();
if(isset($_GET['number'])){
   include "templates/alert_cancel.php"; 
} else {
    include "templates/404error.php";
}
?>

