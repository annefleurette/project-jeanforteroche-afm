<?php
session_start();
if(isset($_GET['number'])){
   include "templates/delete_comment.php"; 
} else {
    include "templates/404error.php";
}
?>
