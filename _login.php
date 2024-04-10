<?php
require_once "./dbconfig.php";

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `users` WHERE `email` = '$email' ";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        if(password_verify($password,$row['password'])){
            session_start();
            $_SESSION["uid"] = $row['userid'];
            $_SESSION["uname"] = $row['name'];
            header("location: home.php");
        }else{
            header("location: login.php?error=wrongcredentiapassword");
        }
    } else {
        header("location: login.php?error=nosuchemail");
        exit();
    }
}