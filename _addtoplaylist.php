<?php
session_start();
require_once "./dbconfig.php";

$usr = $_SESSION["uid"];
if ($usr && isset($_POST["add"])) {
    $sid = $_POST["songid"];
    $playid = $_POST["playlisttoadd"];

    $sql  = "SELECT * FROM `playlistsongs` WHERE  `playid`='$playid' AND `sid`='$sid'";
    $res = mysqli_query($conn,$sql);
    if($res){
        if(mysqli_num_rows($res) == 1){
            header("location: home.php?error=alreadyadded");
            exit();
        }
    }
    $sql  = "INSERT INTO `playlistsongs`(`playid`, `sid`) VALUES ('$playid','$sid')";
    $res = mysqli_query($conn,$sql);
    if($res){
        header("location: home.php?status=added");
    }else{
        header("location: home.php?status=error");
    }
} else {
    header("location: home.php");
}
