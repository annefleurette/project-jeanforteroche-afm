<?php
session_start();
if(isset($_SESSION['pseudo']) AND ($_SESSION['type'] == "admin")){
   include "templates/admin.php"; 
} else {
    include "templates/404error.php";
}
?>