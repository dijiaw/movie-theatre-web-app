<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hogwarts Village</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./login.css" />
    <script type= "text/javascript" src="../validator.js"></script>
</head>
<body>
    <?php include "../header.php" ?>
    <div class="mainbody">
        <div class="existingmember">
            <form class="existingmember-form" action="action-login.php" method="post">
                <h2>Login as our existing member </h2>
                <label>Username:</label>
                <input type="text" name="existingusername" id="existingusername" required><br>
                <label>Password:</label>
                <input type="password" name="existingpassword" id="existingpassword" required><br>
                <input type="submit" value="Login" class="login-submit">
            </form>
        </div>

        <div class="newmember">
            <form class="newmember-form" action="action-register.php" method="post">
                <h2>Register as our new member</h2>
                <label>Name: </label>
                <input type="text" name="newname" id="newname" required><br>
                <label>Username: </label>
                <input type="text" name="newusername" id="newusername" required><br>
                <label>Email: </label>
                <input type="email" name="newemail" id="newemail" required><br>
                <label>Password: </label>
                <input type="password" name="newpassword" id="newpassword" required><br>
                <label>Confirm password: </label>
                <input type="password" name="confirmpassword" id="confirmpassword" required><br>
                <div id="buttons">
                    <input type="reset" value="Reset" class="reset">
                    <input type="submit" value="Submit" class="register-submit">
                </div>
            </form>
            <script type = "text/javascript" src = "index.js"></script>
        </div>
    </div>

<?php include '../footer.php' ?>