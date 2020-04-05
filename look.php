<?php
session_start();
if(isset($_GET['number'])){
   include "templates/look.php"; 
} else {
    include "templates/404error.php";
}
?>
