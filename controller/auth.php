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

    if ($result) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['id'] = $result['id'];
        $_SESSION['name'] = $result['name'];
        $_SESSION['role'] = $result['role'];

        // Cek apakah role adalah admin
        if ($result['role'] == 'admin') {
            // Jika admin, arahkan ke halaman admin_manage_products.php
            return header("location:../admin_manage_products.php");
        } else {
            // Jika bukan admin, arahkan ke halaman utama
            return header("location:../index.php");
        }
    }
    
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