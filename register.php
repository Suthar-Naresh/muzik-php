<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
    <title>Register</title>
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

        .validation {
            background: #376488;
            padding: 10px;
            margin-top: 30px;
            border-radius: 8px;
            box-shadow: 0 15px 25px rgb(0 0 0 / 15%);
            width: 300px;
        }

        .validation ul {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .validation ul li {
            position: relative;
            list-style: none;
            color: #fff;
            font-size: 0.85em;
            transition: 0.5s;
        }

        .validation ul li::before {
            content: '\25Ef';
            width: 20px;
            height: 10px;
            /* background: red; */
            display: inline-flex;
        }

        .validation ul li.valid {
            color: rgb(255, 255, 255, 0.5);
        }

        .validation ul li.valid::before {
            content: '\2714';
            width: 20px;
            height: 10px;
            /* background: red; */
            display: inline-flex;
            color: #00ff00;
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
    <form action="./_register.php" method="post" autocomplete="off">
        <div class="box">
            <div class="inputBox">
                <input required type="text" name="name" placeholder="Enter your name">
            </div>
            <br>
            <div class="inputBox">
                <input required type="email" name="email" placeholder="Enter your email">
            </div>
            <br>
            <div class="inputBox">
                <input required type="password" name="password" id="pswrd" placeholder="Password" onkeyup="checkPassword(this.value)">
                <span id="toggleBtn"></span>
            </div>
            <button type="submit" name="register">Register</button>
        </div>
    </form>
    <!-- <div class="validation">
        <ul>
            <li id="lower">At least one lowercase character</li>
            <li id="upper">At least one uppercase character</li>
            <li id="number">At least one number</li>
            <li id="special">At least one special character</li>
            <li id="length">At least 8 characters long</li>
        </ul>
    </div> -->
    <p class="extralinks">
        Already have an account?<a href="./login.php"> Login Now!</a>
    </p>
    <p class="extralinks">
        Go back to <a href="./index.php">main</a> page.
    </p>
    <br>
    <p class="error" style="color: #ff4242;">
        <?php
        if (isset($_GET["error"])) {
            echo "Email already exists!";
        }
        ?>
    </p>
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

        // checking data
        let lower = document.getElementById('lower');
        let upper = document.getElementById('upper');
        let digit = document.getElementById('number');
        let special = document.getElementById('special');
        let minlength = document.getElementById('length');

        // function for validation using regex
        function checkPassword(data) {
            const lowercase = new RegExp('(?=.*[a-z])');
            const uppercase = new RegExp('(?=.*[A-Z])');
            const number = new RegExp('(?=.*[0-9])');
            const specialchar = new RegExp('(?=.*[!@#\$%\^&\*])');
            const length = new RegExp('(?=.{8,})');

            // Check for lowercase
            if (lowercase.test(data)) {
                lower.classList.add('valid');
            } else {
                lower.classList.remove('valid');
            }

            // Check for uppercase
            if (uppercase.test(data)) {
                upper.classList.add('valid');
            } else {
                upper.classList.remove('valid');
            }

            // Check for number
            if (number.test(data)) {
                digit.classList.add('valid');
            } else {
                digit.classList.remove('valid');
            }

            // Check for special character
            if (specialchar.test(data)) {
                special.classList.add('valid');
            } else {
                special.classList.remove('valid');
            }

            // Check for minimum length
            if (length.test(data)) {
                minlength.classList.add('valid');
            } else {
                minlength.classList.remove('valid');
            }
        }
    </script>
</body>

</html>