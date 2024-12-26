<?php
session_start();

include '../database/auth.php';

$auth = new Auth();

$action =  $_GET['action'];

if ($action == "login") {
    $result = $auth->login(
        $_POST['email'],
        $_POST['password']
    );
    
    return header("location:../login.php");
}
else if ($action == "register") {
    $auth->register(
        $_POST['name'],
        $_POST['email'],
        $_POST['password']
    );

    return header("location:../login.php");
}

?>
