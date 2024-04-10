<?php
require_once "./dbconfig.php";

if (isset($_POST["register"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `users` WHERE `email` = '$email' ";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 1) {
        header("location: register.php?error=emailexist");
        exit();
    } else {
        $hasedpass = password_hash($password, PASSWORD_DEFAULT);
        $userid = uniqid('',true);
        $sql = "INSERT INTO `users`(`userid`,`name`, `email`,`password`) VALUES ('$userid','$name','$email','$hasedpass')";
        $res = mysqli_query($conn, $sql);

        if($res){
            header("location: login.php");
        }
    }
}