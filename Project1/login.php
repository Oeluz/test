<!DOCTYPE html>
<header>
    <title>Project 1 - Login</title>
</header>
<body>
    <form name='login' onsubmit="login()" method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username">

        <label for="password">Password: </label>
        <input type="password" name="password">

        <input type="button" id="loginBtn" value="Log in" onclick="log_in()">
        <!-- <input type="submit" value="Log in""> -->

        <a href="registration.php">First time? Click here to register!</a>
    </form>
</body>

<script src="js/login.js"></script>
</html>