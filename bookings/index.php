<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hogwarts Village</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./bookings.css" />
    <script src="index.js"></script>
</head>
<body>
    <?php include "../header.php" ?>
    <div class="mainbody">
        <div class="booking">
            <p>You can check your booking history with a booking reference number. Please note that you need to login first.</p>
            <br>
            <form class="booking-form" method="post" action="booking.php">
                <label id='label'>Booking reference number: </label>
                <input type="text" name='reference' id='reference' required>
                        <?php
                        if(!isset($_SESSION['user'])){
                            echo '<button id="confirm" onclick="popup()">Confirm</button>';
                        }
                        else {
                            echo '<a href="retrive.php">
                                    <button id="confirm" >Confirm</button>
                                </a>';
                        }
                        ?>
            </form>
            <script type = "text/javascript" src = "index.js"></script>
        </div>
    </div>

    <?php include '../footer.php' ?>