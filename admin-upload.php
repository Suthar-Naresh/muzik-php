<?php
include_once "./dbconfig.php";

if (isset($_POST["upload"])) {
    $name = $_POST["name"];
    $genre = $_POST["genre"];
    $creator = $_POST["creator"];
    $movie = $_POST["movie"];

    $songfile = $_FILES["songfile"]["name"];
    $errorsongfile = $_FILES["songfile"]["error"];
    $tmpsongfile = $_FILES["songfile"]["tmp_name"];

    $posterfile = $_FILES["posterfile"]["name"];
    $errorposterfile = $_FILES["posterfile"]["error"];
    $tmpposterfile = $_FILES["posterfile"]["tmp_name"];

    // print_r($_FILES["songfile"]);

    if (($errorsongfile === 0) && ($errorposterfile === 0)) {
        echo "ALL GOOD!";
        $newsongfile = uniqid('', true).".".pathinfo($songfile,PATHINFO_EXTENSION);
        $newposterfile = uniqid('', true).".".pathinfo($posterfile,PATHINFO_EXTENSION);

        $songdestination = "uploads/" . $newsongfile;
        $posterdestination = "uploads/" . $newposterfile;

        $id = uniqid('', true);
        
        $sql ="INSERT INTO `songs`(`id`, `name`, `genre`, `creator`, `movie`, `songpath`, `posterpath`) VALUES ('$id','$name','$genre','$creator','$movie','$songdestination','$posterdestination')";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            move_uploaded_file($tmpsongfile, $songdestination);
            move_uploaded_file($tmpposterfile, $posterdestination);
            header("Location: index.php");
        } else {
            echo "Unable to store the data into DB";
        }
    } else {
        echo '<p>Error while uploading the files... Try AGAIN...</p>';
    }
} else {
    echo '<div>
    <h1>Can\'t upload file!! ask developer to fix this :) or click the upload button ;) </h1>
    </div>';
}