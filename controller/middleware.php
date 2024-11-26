<?php

if(!isset($_SESSION['loggedIn'])) {
    return header("location:../project-WAP/login.php");
}

?>