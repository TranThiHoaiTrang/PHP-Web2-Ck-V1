<?php
    session_start();
    if (isset($_SESSION["lgUserID"])) {
        unset($_SESSION["lgUserName"]);
        unset($_SESSION["lgUserID"]);
        if (isset($_SESSION["lgCart"])) {
            unset($_SESSION["lgCart"]);
        }
        header('location: index.php');
        
    }
   
    ?>