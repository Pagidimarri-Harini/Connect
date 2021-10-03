
<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN</title>
        <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <title>LOGIN</title>
        <form action="login.php" method="post">
            <h2>LOGIN</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            Username <input type="text" name="username" placeholder="username" required><br>
            Password <input type="password" name="password" placeholder="password" required><br>
            <button type="submit">Login</button>
            <div class="signup">
                Don't have an account?<a href="#">Signup</a></div> 
        </form>
    </body>
</html>
