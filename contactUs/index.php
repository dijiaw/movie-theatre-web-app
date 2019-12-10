<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hogwarts Village</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./contactUs.css" />
    <script type= "text/javascript" src="../validator.js"></script>
</head>
<body>
    <?php include "../header.php" ?>

    <div class="mainbody">

        <h3>Contact Us</h3>

        <div class="about-us">
            <ul>
                <li>Cinema Address: <Address>School of EEE, 50 Nanyang Ave, 639798</Address></li><br>
                <li>Contact Number: <Address>+65-6790-5367</Address></li><br>
                <li>Email Address: <Address>village@hogwarts.com</Address></li><br>
                <li>Our Operating Hours: <Address>9am - 6pm; Monday - Friday</Address></li>
            </ul>
        </div>
        <div class="feedback-class">
            <p>Would you like to share your feedback with us?</p>
            <br>
            <form class="feedback-form" method="post" action="feedback.php">
                <label id='label'>Your name: </label>
                <input type="text" name='feedback-name' id='feedback-name' required><br>
                <label id='label'>Your email: </label>
                <input type="email" name='feedback-email' id='feedback-email' required><br>
                <label id='label'>Feedback to share with us: </label><br>
                <textarea name='feedback-content' required></textarea><br>
                <input type="submit" value="Submit" id="submit" onclick=infoPopup()>
            </form>
            <script type = "text/javascript" src = "index.js"></script>
        </div>

    </div>

<?php include '../footer.php' ?>