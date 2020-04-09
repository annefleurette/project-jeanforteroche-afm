<?php
session_start();
if(isset($_GET['id'])){
   include "templates/delete_comment.php"; 
} else {
    include "templates/404error.php";
}
?>
