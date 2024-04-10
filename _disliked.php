<?php
session_start();

require_once "./dbconfig.php";

if (isset($_GET["songid"])) {
    $sid = $_GET["songid"];
    $usrid = $_SESSION["uid"];
    $sql = "DELETE FROM `likedsongs` WHERE `songid`='$sid' AND `userid`='$usrid'";
    $res = mysqli_query($conn, $sql);
    if($res){
        header("location: liked.php");
        
    }else{
        mysqli_error($conn);
        die("ERROR");
    }
    // echo $_GET["songid"].'<br>'.$_SESSION["uid"];
}