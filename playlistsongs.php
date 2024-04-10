<?php
ob_start();
session_start();

require_once "./dbconfig.php";

if (isset($_SESSION["uid"])) ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
    <title>Songs from the play list</title>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Varela+Round&display=swap');

        body {
            background-color: antiquewhite;
        }

        * {
            margin: 0;
            padding: 0;
        }

        nav {
            font-family: 'Ubuntu', sans-serif;
        }

        nav ul {
            display: flex;
            align-items: center;
            list-style-type: none;
            height: 65px;
            background-color: black;
            color: white;
        }

        .listsong {
            /* border: 1px solid red; */
            max-height: 500px;
            overflow: auto;
            /* scroll-behavior: smooth; */
        }

        ::-webkit-scrollbar {
            width: 0px;
        }

        nav ul li {
            padding: 0 12px;
        }

        nav ul li a {
            padding: 0 37px;
            font-size: larger;
            color: white;
            text-decoration: none;
        }

        .app img {
            width: 44px;
            padding: 0 8px;
        }

        .app {
            display: flex;
            align-items: center;
            font-weight: bolder;
            font-size: 1.3rem;
        }

        .forcss {
            min-height: 72vh;
            background-color: black;
            color: white;
            font-family: 'Varela Round', sans-serif;
            display: flex;
            margin: 23px auto;
            width: 70%;
            border-radius: 12px;
            padding: 34px;
            background-image: url('bg.jpg');
        }

        .bottom {
            position: sticky;
            bottom: 0;
            height: 130px;
            background-color: black;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .icons {
            margin-top: 14px;
        }

        .icons i {
            cursor: pointer;
        }

        #bar {
            width: 80vw;
            cursor: pointer;
        }

        .songitemcontainer {
            margin-top: 74px;
        }

        .songitem {
            height: 50px;
            display: flex;
            background-color: white;

            color: black;
            margin: 12px 0;
            justify-content: space-between;
            align-items: center;
            border-radius: 34px;
        }

        .songitem img {
            width: 43px;
            margin: 0 23px;
            border-radius: 34px;
        }

        .times {
            margin: 0 23px;
        }

        .times i {
            cursor: pointer;
        }

        .songinfo {
            position: absolute;
            left: 10vw;
            font-family: 'Varela Round', sans-serif;
        }

        .songinfo img {
            opacity: 0;
            transition: opacity 0.4s ease-in;
        }

        @media only screen and (max-width: 1100px) {
            body {
                background-color: red;
            }
        }

        nav {
            display: flex;
            background: black;
            width: 100%;
        }

        li#logout {
            background: #7c7276bd;
            width: 130px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 3px;
            padding: 10px;
            font-family: 'Varela Round', sans-serif;
        }

        li.user {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: 350px;
            gap: 15px;
        }

        li#logout:hover {
            background: white;
        }

        li#logout:hover a {
            color: black;
        }

        li a:hover {
            color: #4defff;
        }
    </style>
</head>

<body>
    <?php if ($_GET["pname"] && $_GET["playid"] && isset($_SESSION["uid"])) { ?>
        <nav>
            <ul>
                <li class="app"><img src="logo.png" alt="Spotify"> Muzik</li>
                <li><a href="home.php">Home</a></li>
                <li><a href="./liked.php">Liked Songs</a></li>
                <li><a href="./playlist.php">Play Lists</a></li>
                <li><a href="About.php">About</a></li>
                <!-- <li><a href="./playlist.php">Playlists</a></li> -->
                <li id="logout"><a href="./_logout.php">LOGOUT</a></li>
                <li class="user">
                    <img src="./icons/account_circle.svg" alt="user">
                    Logged in as
                    <?php echo $_SESSION["uname"]; ?>
                </li>
            </ul>
        </nav>

        <div class="forcss">
            <div class="listsong">
                <a href="./playlist.php"><img src="./icons/back.svg"></a>
                <h1>Songs present in playlist : <?php echo $_GET["pname"]; ?></h1>
                <div class="songitemcontainer">
                    <?php
                    $usrid = $_SESSION["uid"];
                    $plid = $_GET["playid"];
                    $sql = "SELECT * FROM `songs`,`playlistsongs` WHERE `songs`.`id`=`playlistsongs`.`sid` AND `playlistsongs`.`playid` = '$plid'";
                    $res = mysqli_query($conn, $sql);
                    $idx = 0;
                    if ($res) {
                        $songlist = null;
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $list[] = array("songName" => $row["name"], "filePath" => $row["songpath"], "coverPath" => $row["posterpath"]);
                                echo '
            <div class="songitem">
                <img alt="pic">
                <span class="songName" style="width: 100px;">' . $row["name"] . '</span>
                <span class="songlistplay">
                                    <span class="times">
                                        <span class="timeCurrent"></span>
                                        <span class="songItemPlay">
                                            <img id="' . $idx . '" status="paused" src="./icons/bplay.svg" style="cursor:pointer;width:25px;height:25px;" />
                                        </span>
                                    </span>
                                </span>
                <a  href="./_removefromplaylist.php?songid=' . $row["id"] . '&playid=' . $row["playid"] . '">
                <img src="./icons/playlist_remove.svg" style="width:30px;" />
                </a>
            </div>
            ';
                                $idx++;
                            }
                            $songlist = json_encode($list);
                            echo '</div>
            </div>
            <div class="songbackground"></div>
        </div>

        <div class="bottom">
            <div style="display: flex;width: 79%;align-items: center;justify-content: space-between;font-size: 20px;font-family: cursive;">
                <span id="ct">0:00</span>
                <span id="md">0:00</span>
            </div>
            <div id="progress" style="width: 80%;border: 1px solid white;padding: 2px;border-radius: 5px;">
                <div id="progressBar" style="border:1px solid cyan;width:0%;"></div>
            </div>
            <div class="icons" style="display: flex;width: 400px;align-items: center;justify-content: space-between;">
                <div id="loopsong" style="border: 1px dotted;padding: 2px;cursor:pointer;">LOOP</div>
                <span  id="previous"><img style="cursor:pointer;" src="./icons/skip_previous.svg" alt="prev"></span>
                <span  id="masterPlay"><img style="cursor:pointer;" src="./icons/play_circle.svg" alt="play-pause"></span>
                <span  id="next"><img style="cursor:pointer;" src="./icons/skip_next.svg" alt="next"></span>
                <div id="shufflesong" style="border: 1px dotted;padding: 2px;cursor:pointer;">SHUFFLE</div>
            </div>
            <div class="songinfo">
                <img src="playing.gif" width="42px" alt="" id="gif"> <span id="masterSongName">&nbsp;</span>
            </div>
        </div>';
                    ?>
                            <?php require_once "./player.php"; ?>
                    <?php
                            // header("location: home.php?donealready");
                        } else {
                            echo 'Play List is empty!';
                        }
                    } ?>
</body>

</html>
<!-- <?php } else {
        header("location: index.php");
    } ?> -->