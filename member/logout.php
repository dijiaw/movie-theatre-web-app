<?php 
    session_start();
    $old_user = $_SESSION['user'];
    unset($_SESSION['user']);
    session_destroy();
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
        <?php if(!empty($old_user)): ?>
        <p>
            You have logged out.<br>
            The page will be automatically re-navigated to Homepage in <span id="count">3</span> seconds.<br>
            If it does not direct you back to Homepage automatically, please kindly <a href="../index.php">click here</a>.
        </p>
        <script type="text/javascript" src="../counter.js"></script>
        <?php endif; ?>
        <?php if(empty($old_user)): ?>
        <p>
            You were not logged in, and so have not been logged out.<br> 
            Back to <a href='../index.php'>Homepage</a>..
        </p>
        <?php endif; ?>
    </div>

<?php include "../footer.php" ?>