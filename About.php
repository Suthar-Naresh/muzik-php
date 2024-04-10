<?php
session_start();
require_once "./dbconfig.php";

if (isset($_SESSION["uid"])) {
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
  <title>About Muzik</title>
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

    .column {
      float: left;
      width: 33.3%;
      margin-bottom: 16px;
      padding: 0 8px;
    }

    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      margin: 8px;
    }

    .about-section {
      padding: 50px;
      text-align: center;
      background-color: #474e5d;
      color: white;
    }

    .container {
      padding: 0 16px;
    }

    .container::after,
    .row::after {
      content: "";
      clear: both;
      display: table;
    }

    .title {
      color: grey;
    }

    .button {
      border: none;
      outline: 0;
      display: inline-block;
      padding: 8px;
      color: white;
      background-color: #000;
      text-align: center;
      cursor: pointer;
      width: 100%;
    }

    .button:hover {
      background-color: #555;
    }

    .button a {
      text-decoration: none;
      color: white;
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

    .listsong {
      font-family: 'Varela Round', sans-serif;
    }

    ul {
      list-style: none;
      line-height: 25px;
    }

    #sociallinks a {
      color: #4defff;
      font-style: italic;
    }

    li a:hover {
      color: #4defff;
    }

    @media screen and (max-width: 650px) {
      .column {
        width: 100%;
        display: block;
      }
    }
  </style>
</head>

<body>

  <nav>
    <ul>
      <li class="app"><img src="logo.png" alt="Spotify"> Muzik</li>
      <li><a href="home.php">Home</a></li>
      <li><a href="./liked.php">Liked Songs</a></li>
      <li><a href="./playlist.php">Play Lists</a></li>
      <li><a href="About.php">About</a></li>
      <!-- <li><a href="./playlist.php">Playlists</a></li> -->

      <?php
      if (isset($_SESSION["uid"])) {?>
      <li id="logout"><a href="./_logout.php">LOGOUT</a></li>
      <li class="user">
        <img src="./icons/account_circle.svg" alt="user">
        Logged in as
        <?php echo $_SESSION["uname"]; }?>
      </li>
    </ul>
  </nav>


  <div class="forcss">
    <div class="listsong">
      <h1>About Muzik</h1>
      <br>
      <h2>Why Muzik?</h2>
      <ul>
        <br>
        <li>Muzik has the large library of high quality songs.</li>
        <li>Muzik has the large library of high quality songs.</li>
        <li>Muzik has all the functionalities of a music player.</li>
        <li>At muzik you can like and dislike a song.</li>
        <li>Users can make and delete playlists of songs.</li>
        <li>Users can add and remove songs from a playlist.</li>
      </ul>
      <br><br>
      <h2>What is Muzik?</h2>
      <ul>
        <br>
        <li>Muzik is a website where you can listen songs online.</li>
        <li id="sociallinks">Created by <a href="https://in.linkedin.com/in/naresh-suthar-405040213" target="_blank" rel="noopener noreferrer">Suthar Naresh</a> and <a href="https://in.linkedin.com/in/nikhil-satwani-b19b50216" target="_blank" rel="noopener noreferrer">Nikhil Satwani</a>.</li>
        <li style="display: flex;align-items: center;justify-content: flex-start;">Made with &nbsp;<img style="height:25px;" src="./icons/liked.svg" alt="love">&nbsp; in India.</li>
      </ul>
    </div>
    <div>
      <img src="./logo.png" alt="logo" style="width: 70%;transform: translate(10rem,2rem);">
    </div>
  </div>
</body>

</html>
<?php }else{
  header("location: index.php");
}?>