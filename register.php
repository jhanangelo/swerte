<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login&signup</title>
    <link rel="stylesheet" href="Loginstyle.css">
</head>

<p>Make an account for employee? <a href="#" class="register-link">Register</a></p>

<div class="form-box register">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="username", name="username", id="username" autocomplete="off" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email", name="email", id="email" autocomplete="off" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password", name="password", id="password" autocomplete="off" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">I
                    agree to the terms & conditions</label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>Already a member? <a href="#" class="login-link">logIn</a></p>
                </div>
            </form>
        </div>
    </div>
