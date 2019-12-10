<?php
    include "../dbconnect.php";
    session_start();
    ini_set('display_errors', 1);
    if(isset($_POST['existingusername']) && isset($_POST['existingpassword'])){
        $username = $_POST['existingusername'];
        $password = $_POST['existingpassword'];
        $password = md5($password);
        $query = "select * from member where username='".$username."' and password='".$password."'";
        $matched = $db->query($query);
        if (!$matched) {
            echo "Error occurred when retrieving poster!";
        } else {
            if($matched->num_rows>0){
                $_SESSION['user'] = $username;
            } else {
                if(isset($_SESSION['user'])){
                    unset($_SESSION['user']);
                    session_destroy();
                }
            }
        }
        $matched->free();
        $db->close();
    }
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hogwarts Village</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./index.css" />
</head>
<body>

    <div class="main-body">
        <?php if(isset($_SESSION['user'])): ?>
        <p>
            Welcome to Hogwarts Village! <span class="username"><?php echo $_SESSION['user'] ?></span>!<br><br>
            You will be auto-directed to our home page in <span id="count">3</span> seconds.<br>
            It the page didn't direct you automatically, please kindly click <a href="../index.php">here</a>.
        </p>
        <script type="text/javascript" src="../counter.js"></script>
        <?php endif; ?>
        <?php if(!isset($_SESSION['user'])): ?>
        <p>Your username and password did't match our records. Please <a href='login.php'>login</a> again or back to <a href='../index.php'>home page</a>..</p>
        <?php endif; ?>
    </div>

<?php include "../footer.php" ?>