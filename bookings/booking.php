<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hogwarts Village</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./bookings.css" />
</head>
<body>
    <?php include "../header.php" ?>
    <div class="mainbody">
        <h2>Review booking</h2>
        <?php 
        $msg = "We found your booking record! You can review it below.";
        $reference = $_POST['reference'];
        include "../dbconnect.php";
        $query = "select * from booking where reference ='".$reference."'";
        $matched = $db->query($query);
        if (!$matched) {
            echo "An error occurred when retriving booking information!";
        } else {
            $booking = $matched->fetch_assoc();
            $slotid = $booking['slotid'];
        }
        $matched->free();

        $query = "select * from showtime where slotid=".$slotid;
                $matched = $db->query($query);
                if (!$matched) {
                    echo "Error occurred when retrieving show time information!.";
                } else {
                    $s = $matched->fetch_assoc();
                }
        $matched->free();

        $query = "select name from movie where movieid=".$s['movieid'];
        $matched = $db->query($query);
        if (!$matched) {
            echo "Error occurred when retrieving movie information!";
        } else {
            $movie = $matched->fetch_assoc();
        }
        $matched->free();
        $db->close();
        
                echo "<div class='ticket'>
                        <h4>Ticket Information</h4>
                        <table>
                            <tr><td class='left-col'>Movie:</td><td>".$movie['name']."</td></tr>
                            <tr><td class='left-col'>Date and Time:</td><td>".$s['dateofshow']." ".$s['slot']."</td></tr>
                            <tr><td class='left-col'>Hall:</td><td>".$s['hall']."</td></tr>
                            <tr><td class='left-col'>Seat(s):</td><td>".$booking['seats']."</td></tr>
                        </table>
                    </div>";

        // $msg = "Movie: ".$movie['name']."; Hall: ".$s['hall']."; Date and Time: ".$s['dateofshow']." ".$s['slot']."; Seat(s): ".$seats.".";
        ?>
    </div>

<?php include '../footer.php' ?>