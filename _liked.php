<?php
session_start();

require_once "./dbconfig.php";

if (isset($_GET["songid"])) {
    $sid = $_GET["songid"];
    $usrid = $_SESSION["uid"];
    $sql = "SELECT * FROM `likedsongs` WHERE `songid`='$sid' AND `userid`='$usrid'";
    $res = mysqli_query($conn, $sql);
    if($res){
        if(mysqli_num_rows($res)==1){
            header("location: home.php?response=donealready");
            exit();
        }
    }else{
        mysqli_error($conn);
        die("ERROR");
    }

    $sql = "INSERT INTO `likedsongs`(`songid`, `userid`) VALUES ('$sid','$usrid')";
    $res = mysqli_query($conn, $sql);
    if($res){
        header("location: home.php");
    }else{
        header("location: home.php?error=inserterror");
    }
    // echo $_GET["songid"].'<br>'.$_SESSION["uid"];
}