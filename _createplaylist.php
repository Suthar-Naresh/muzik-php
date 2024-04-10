<?php
session_start();
require_once "./dbconfig.php";

$usr = $_SESSION["uid"];
if ($usr && isset($_POST["createplaylist"])) {
    $pname = $_POST["playlistname"];
    if(empty(trim($pname," "))){
        header("location: playlist.php?status=emptypname");
        exit();
    }
    $usrid = $_SESSION["uid"];
    $sql = "INSERT INTO `playlist`(`name`, `uid`) VALUES ('$pname','$usr')";
    $res = mysqli_query($conn, $sql);
    if($res){
        header("location: playlist.php?status=created");
    }else{   
        header("location: playlist.php?status=error");
    }
} else {
    header("location: home.php");
}
