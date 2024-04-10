<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
    <title>Muzik - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: monospace;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #1A3951;
            flex-direction: column;
        }

        .box {
            position: relative;
            width: 300px;
        }

        .box .inputBox {
            position: relative;
            width: 100%;
            background: #fff;
            padding: 5px;
            border-radius: 8px;
            box-shadow: 0 15px 25px rgb(0 0 0 / 15%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box .inputBox input {
            position: relative;
            width: 100%;
            outline: none;
            border: none;
            padding: 10px 5px;
        }

        .box .inputBox #toggleBtn {
            position: absolute;
            width: 34px;
            height: 34px;
            background: rgb(0 0 0 / 5%);
            right: 10px;
            /* top: 8px; */
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .box .inputBox #toggleBtn::before {
            content: '\1F441';
            font-size: 20px;
        }

        .box .inputBox #toggleBtn.hide::before {
            content: '\2716';
            font-size: 20px;
        }

        button {
            width: 60%;
            height: 40px;
            margin: 10px auto;
            justify-content: center;
            display: block;
            color: #fff;
            background: #2a6593;
            font-size: 1em;
            font-weight: bold;
            margin-top: 20px;
            outline: none;
            border: none;
            border-radius: 5px;
            transition: .2s ease-in;
            cursor: pointer;
        }

        button:hover {
            background: #2b74b3;
        }

        .extralinks {
            color: white;
            font-size: 20px;
            margin-top: 20px;
        }

        .extralinks a {
            color: #ddd5d5;
            text-decoration-color: #19d5ff;
        }
    </style>
</head>

<body>
    <form action="./_login.php" method="post" autocomplete="off">
        <div class="box">
            <div class="inputBox">
                <input type="email" name="email" placeholder="Enter your email">
            </div>
            <br>
            <div class="inputBox">
                <input type="password" name="password" id="pswrd" placeholder="Password" onkeyup="checkPassword(this.value)">
                <span id="toggleBtn"></span>
            </div>
            <button type="submit" name="login">Login</button>
        </div>
        <p class="extralinks">
            Don't have an account?<a href="./register.php"> Register</a>
        </p>
        <p class="extralinks">
            Go back to <a href="./index.php">main</a> page.
        </p>
    </form>
    <br>
    <p class="error" style="color: #ff4242;">
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] === 'wrongcredentiapassword') {
                echo "Wrong password!";
            }
            if ($_GET["error"] === 'nosuchemail') {
                echo "User with this email doesn't exist!";
            }
        }
        ?>

        <script>
            document.querySelector('input[type="email"]').onfocus = () => {
                document.querySelector('.error').innerHTML = "";
            }
            let pswrd = document.getElementById('pswrd');
            let toggleBtn = document.getElementById('toggleBtn');

            // show hide password
            toggleBtn.onclick = () => {
                if (pswrd.type === 'password') {
                    pswrd.setAttribute('type', 'text');
                    toggleBtn.classList.add('hide');
                } else {
                    pswrd.setAttribute('type', 'password');
                    toggleBtn.classList.remove('hide');
                }
            }
        </script>
</body>

</html>