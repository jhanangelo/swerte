<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Suerte Motoplaza</title>
    <link rel="stylesheet" href="Loginstyle.css">
</head>

<body>

    <header>
        <img src="FB_IMG_1744374036883.jpg" alt="Header Image" height="65px" width="105px" style="margin-left: 5px; text-align: left;">
        <nav class="navigation">
            <button class="btnLogin-popup">Login</button>
            </nav>
    </header>

    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close-outline"></ion-icon>
        </span>

        <div class="form-box login">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="username" id="username" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>" required>
                    <label>Username</label>
            </div>
                <div class="input-box">
            <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
            <input type="password" name="password" id="password" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>" required>
            <span class="toggle-password" onclick="togglePassword()">
            </span>
            <label>Password</label>
        </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

    <script src="Loginscript.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const wrapper = document.querySelector('.wrapper');
        const btnPopup = document.querySelector('.btnLogin-popup');
        const iconClose = document.querySelector('.icon-close');

        btnPopup.addEventListener('click', () => {
            wrapper.classList.add('active-popup');
        });

        iconClose.addEventListener('click', () => {
            wrapper.classList.remove('active-popup');
        });
    });
</script>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.name = "eye-off-outline";
        } else {
            passwordInput.type = "password";
            eyeIcon.name = "eye-outline";
        }
    }
</script>

</body>
</html>
