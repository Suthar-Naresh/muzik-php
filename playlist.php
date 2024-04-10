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
    <title>Play Lists</title>
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
            margin: 23px auto;
            width: 70%;
            border-radius: 12px;
            padding: 34px;
            background-image: url('bg.jpg');
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

        .playlistarea {
            display: grid;
            margin-top: 20px;
            grid-gap: 21px;
            grid-template-columns: 300px 300px 300px;
        }

        .playlistitem {
            /* border: 1px solid yellow; */
            border-radius: 5px;
            box-shadow: 0px 0px 13px 5px #4242423d;
            background: white;
            height: 50px;
            color: black;
            display: flex;
            width: 300px;
            font-size: 28px;
            align-items: center;
            justify-content: space-around;
            font-family: 'Varela Round', sans-serif;
        }

        .playlistitem a {
            text-decoration: none;
            color: black;
            font-family: 'Varela Round', sans-serif;
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

        input[type="text"] {
            width: 300px;
            margin-top: 50px;
            margin-bottom: 10px;
            height: 35px;
            border-radius: 5px;
            border: none;
            outline: none;
            padding: 0 10px;
        }

        input[type="submit"] {
            display: inline-flex;
            height: 35px;
            width: 150px;
            margin-left: 100px;
            cursor: pointer;
            border: none;
            color: #3c3a3a;
            border-radius: 2px;
            font-size: 20px;
            background: floralwhite;
            font-family: 'Varela Round', sans-serif;
            align-items: center;
            justify-content: center;
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
        li a:hover{
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
                <h1>Play Lists created By <?php echo $_SESSION["uname"]; ?></h1>
                <form action="./_createplaylist.php" method="post" autocomplete="off">
                    <input type="text" name="playlistname" placeholder="Enter play list name">
                    <input type="submit" value="Create Now" name="createplaylist">
                </form>
                <div class="playlistarea">
                    <?php
                    $usrid = $_SESSION["uid"];
                    $sql = "SELECT * FROM `playlist` WHERE `uid` = '$usrid'";
                    $res = mysqli_query($conn, $sql);
                    if ($res) {
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo '
                                <div class="playlistitem">
                                <img src="icons/add_to_playlist.svg" width="35px">
                                <a href="playlistsongs.php?playid=' . $row["id"] . '&pname=' . $row["name"] . '">' . $row["name"] . '
                                    </a>
                                    <a href="_deleteplaylist.php?playid=' . $row["id"] . '&pname=' . $row["name"] . '">
                                        <img src="icons/delete.svg" height="30px">
                                    </a>
                                </div>';
                            }
                        }else{
                            echo'No playlists yet! Create one now';
                        }
                    } ?>
                </div>
            </div>
            <div class="songbackground"></div>
        </div>
</body>

</html>
<?php } else {
        header("location: index.php");
} ?>