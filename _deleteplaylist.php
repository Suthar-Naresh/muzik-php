<?php
session_start();
require_once "./dbconfig.php";

$usr = $_SESSION["uid"];
if (isset($_GET["pname"]) && isset($_GET["playid"])) {
    $sid = $_GET["pname"];
    $pid = $_GET["playid"];
    // echo $sid ."<br>".$pid;
    $sql  = "DELETE FROM `playlist` WHERE `name`='$sid' AND `id`='$pid';";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $sql  = "DELETE FROM `playlistsongs` WHERE `playid`='$pid';";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            header("location: playlist.php?status=playlistdeleted");
        }
    } else {
        header("location: playlist.php?status=error");
    }
}
// else {
//     header("location: home.php");
// }