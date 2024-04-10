<?php
ob_start();
session_start();
require_once "./dbconfig.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
    <title>Muzik - Your favourite music is here</title>
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

        .listsong {
            /* border: 1px solid red; */
            max-height: 500px;
            overflow: auto;
            /* scroll-behavior: smooth; */
        }
        ::-webkit-scrollbar{
            width: 0px;
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

        #addtolike {
            font-size: 12px;
        }

        #popup {
            display: none;
            /* border: 1px solid red; */
            background: #fff;
            width: 300px;
            height: 200px;
            transform: translate(50px, 110px);
            border-radius: 3px;
            box-shadow: 0px 0px 20px 1px #8f8a8a7a;
            padding: 10px;
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

        li#logout:hover {
            background: white;
        }

        li#logout:hover a {
            color: black;
        }

        li.user {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: 350px;
            gap: 15px;
        }

        select {
            width: 200px;
            height: 30px;
            outline: none;
        }

        #selectbtn {
            cursor: pointer;
            width: 100px;
            margin-top: 20px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            /* background: whitesmoke; */
        }

        li a:hover {
            color: #4defff;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION["uid"])) { ?>
        <nav>
            <ul>
                <li class="app"><img src="logo.png" alt="Spotify"> Muzik</li>
                <li><a href="home.php">Home</a></li>
                <li><a href="./liked.php">Liked Songs</a></li>
                <li><a href="./playlist.php">Play Lists</a></li>
                <li><a href="About.php">About</a></li>
                <!-- <li><a href="./playlist.php">Playlists</a></li> -->

                <?php
                if (isset($_SESSION["uid"])) ?>
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
                <h1>List of songs Available at Muzik</h1>
                <div class="songitemcontainer">
                    <?php
                    $usr = $_SESSION["uid"];
                    $sql = "SELECT * FROM `songs`;";
                    $lsql = "SELECT `songid` FROM `likedsongs` WHERE `userid`='$usr';";

                    $res = mysqli_query($conn, $sql);
                    $lres = mysqli_query($conn, $lsql);

                    if ($lres) {
                        $liked = array();
                        if (mysqli_num_rows($lres) > 0) {
                            while ($lrow = mysqli_fetch_assoc($lres)) {
                                array_push($liked, $lrow["songid"]);
                            }
                        }
                        // echo count($liked);
                        // print_r($liked);
                    }

                    $idx = 0;
                    if ($res) {
                        if (mysqli_num_rows($res) > 0) {
                            // $lrow = null;
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
                                ';
                                if ((count($liked) > 0) && in_array($row["id"], $liked)) {
                                    echo  '
                                    <a   href="./_liked.php?songid=' . $row["id"] . '">
                                    <img src="./icons/liked.svg" style="width:30px;"/>
                                    </a>';
                                } else {
                                    echo  '
                                    <a   href="./_liked.php?songid=' . $row["id"] . '">
                                    <img src="./icons/like.svg" style="width:30px;"/>
                                    </a>';
                                }
                                echo '
                                <img src="./icons/more.svg" style="height:30px;cursor:pointer;width: 30px;color: #7093e1;" class="more" data-songid="' . $row["id"] . '"/>
                                </div>
                            ';
                                $idx++;
                            }
                            $songlist = json_encode($list);
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="songbackground"></div>
            <div id="popup">
                <button onclick="closepopup();" style="background:white;border: none;padding: 5px; cursor:pointer;">
                    <img src="./icons/close.svg" width="30px" alt="Close">
                </button>
                <br>
                <hr>
                <?php
                $usr = $_SESSION["uid"];
                $sql = "SELECT * FROM `playlist` WHERE `uid`='$usr'";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    if (mysqli_num_rows($res) > 0) {
                        echo '<br>
                        <h3><a href="playlist.php">Create new Play List</a></h3><br>
                        <form action="./_addtoplaylist.php" method="post">
                        <input type="hidden" name="songid" id="popdata">
                        <select name="playlisttoadd" id="color">';
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                        }
                        echo '</select>
                        <input type="submit" id="selectbtn" value="Add" name="add">
                        </form>';
                    } else {
                        echo "<h3 style='color:black;'>No Play Lists to select <br>Create <a href='playlist.php'>Now!</a></h3>";
                    }
                }
                ?>
                <!-- <p id="popdata"></p> -->
            </div>
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
        </div>
        <script>
            function closepopup() {
                document.getElementById('popup').style.display = 'none';
            }

            document.querySelectorAll(".more").forEach(el => el.addEventListener('click', () => {
                document.querySelector("#popup").style.display = "block";
                <?php if ((mysqli_num_rows($res) > 0)) { ?>
                    document.querySelector("#popdata").value = el.getAttribute("data-songid");
                <?php } ?>
            }));
        </script>
        <?php require_once "./player.php";?>
    <?php } else {
        header("location: index.php");
    } ?>
</body>

</html>