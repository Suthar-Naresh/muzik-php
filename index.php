<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
    <title>MUZIK</title>
    <!-- <link rel="stylesheet" href="landing.css"> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Varela+Round&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            /* justify-content: center; */
            color: white;
            align-items: center;
            font-family: 'Varela Round', sans-serif;
            height: 100vh;
            width: 100vw;
            flex-direction: column;
            background: url('./landing.webp') no-repeat center fixed;
            opacity: 1;
            background-size: cover;
        }

        a {
            text-decoration: none;
            color: white;
            font-size: 30px;
            font-family: 'Varela Round', sans-serif;
            font-weight: 600;
        }

        button {
            border: none;
            padding: 10px;
            margin-top: 100px;
            width: 300px;
            color: white;
            border-radius: 5px;
            outline: 2px solid white;
            outline-offset: 2px;
            background: linear-gradient(130deg, rgba(2, 146, 187, 1) 0%, rgba(221, 0, 224, 1) 100%);
        }

        div {
            display: flex;
            justify-content: center;
            align-items: center;
            line-height: 40px;
            flex-direction: column;
            margin-top: 100px;
        }

        b {
            background: -webkit-linear-gradient(130deg, rgba(221, 0, 224, 1) 0%,rgba(2, 146, 187, 1) 100%);
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
        }
        #imp{
            background: -webkit-linear-gradient(130deg, rgba(2, 146, 187, 1) 0%,rgba(221, 0, 224, 1) 100%);
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
        }
    </style>

</head>

<body>
    <!-- <img src="./landing.webp"> -->
    <div>
        <h1>Welcome to the world of <b id="imp">MUZIK</b></h1>
        <h2>One stop for all your music needs.</h2>
        <h2>Listen the latest <b>songs</b>, make <b>play lists</b>, and <b>enjoy</b> the life.</h2>
    </div>

    <button>
        <a href="./login.php">Get Started!</a>
    </button>
</body>

</html>