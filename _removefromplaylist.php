<?php
session_start();
require_once "./dbconfig.php";

$usr = $_SESSION["uid"];
if (isset($_GET["songid"]) && isset($_GET["playid"])) {
    $sid =$_GET["songid"];
    $pid =$_GET["playid"];
    // echo $sid ."<br>".$pid;
    $sql  = "DELETE FROM `playlistsongs` WHERE `sid`='$sid' AND `playid`='$pid';";
    $res = mysqli_query($conn,$sql);
    if($res){
        header("location: playlist.php?status=songremovedfromplaylist");
    }else{
        header("location: playlist.php?status=error");
    }
}
// else {
//     header("location: home.php");
// }