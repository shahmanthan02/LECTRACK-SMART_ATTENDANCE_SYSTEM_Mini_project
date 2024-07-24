<?php
   include("faculty_login.php")

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
.input-box i {
  position: absolute;
  right: 30%;
  top: 40%;
  transform: translateY(-50%);
  font-size: 20px;
}
</style>

<body>

<div class="cont">

    <div class="wrapper">

            <div>
                <img class="logo-left" src="adit.png" alt="Logo 1">
                <img class="logo-right" src="cvmu.png" alt="Logo 2">
            </div>

        <div><form method="POST" action="faculty_login.php">
            <h1>Faculty Login</h1>
        </div>
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" onfocus="movePlaceholder(this)" onblur="restorePlaceholder(this)">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" name="password" onfocus="movePlaceholder(this)" onblur="restorePlaceholder(this)">
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="register.html">Register</a></p>
            </div>

        </form>
    </div>

</div>

    <script src="login.js"></script>
    <script>
        function movePlaceholder(inputElement) {
            inputElement.querySelector('::placeholder').style.transform = 'translateY(-150%)';
        }

        function restorePlaceholder(inputElement) {
            if (inputElement.value === '') {
                inputElement.querySelector('::placeholder').style.transform = 'translateY(-50%)';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const inputElements = document.querySelectorAll('.input-box input');

            inputElements.forEach(function (inputElement) {
                inputElement.addEventListener('focus', function () {
                    movePlaceholder(this);
                });

                inputElement.addEventListener('blur', function () {
                    restorePlaceholder(this);
                });
            });
        });
    </script>
</body>

</html>
