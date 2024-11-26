<?php

session_start();

include '../database/pharmacy.php';

$pharmacy = new Pharmacy();
$action =  $_GET['action'];

if ($action == "store") {
    $pharmacy->store(
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_FILES["image"]
    );
    if($store['errors']) {
        $_SESSION['errors'] = true;
        $_SESSION['values'] = $store['values'];
        return header("location:../create.php");
    }
    return header("location:../");
}
else if ($action == "update") {
    $update = $inventory->update(
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_FILES["image"]
    );
    if ($update['errors']) {
        return header("location:../create.php");
    }
    return header("location:../");
}
else if ($action == "delete") {
    $inventory->delete(
        $_GET['id']
    );
    return header("location:../");
}

?>